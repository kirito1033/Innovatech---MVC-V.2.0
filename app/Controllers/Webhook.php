<?php namespace App\Controllers;

use CodeIgniter\HTTP\Response;

class Webhook extends BaseController
{
    // Verificación del webhook (GET)
    public function index()
    {
        $mode = $this->request->getGet('hub_mode');
        $token = $this->request->getGet('hub_verify_token');
        $challenge = $this->request->getGet('hub_challenge');

        log_message('info', '🔍 Verificación recibida: mode=' . $mode . ', token=' . $token . ', challenge=' . $challenge);

        if ($mode === 'subscribe' && $token === 'innovatech2025') {
            return $this->response
                ->setStatusCode(200)
                ->setHeader('Content-Type', 'text/plain')
                ->setBody($challenge);
        } else {
            return $this->response->setStatusCode(403)->setBody('Token inválido');
        }
    }

    // Manejo de mensajes (POST)
    public function indexPost()
    {
        $body = $this->request->getBody();
        log_message('info', '📩 Webhook recibido: ' . $body);

        $data = json_decode($body, true);
        if (empty($data['entry'][0]['changes'][0]['value']['messages'][0])) {
            return $this->response->setStatusCode(200);
        }

        // -------- Datos básicos --------
        $message = $data['entry'][0]['changes'][0]['value']['messages'][0];
        $from    = $message['from'];                       // teléfono remitente
        $text    = strtolower(trim($message['text']['body'] ?? ''));

        log_message('info', '📨 Mensaje de ' . $from . ': ' . $text);

        $cache  = \Config\Services::cache();
        $estado = $cache->get('state_' . $from) ?? null;

        /* ╔══════════════════════════════════════════════════════════╗
        ║ 1) CONSULTA DIRECTA POR RADICADO (ej. "raq-12")          ║
        ╚══════════════════════════════════════════════════════════╝ */
        if (str_starts_with($text, 'raq-')) {
            $id = (int) str_replace('raq-', '', $text);
            $pqrsModel = new \App\Models\PqrsModel();
            $pqrs = $pqrsModel->find($id);

            if ($pqrs) {
                $estadoNombre = (new \App\Models\EstadoPqrsModel())
                                ->find($pqrs['estado_pqrs_id'])['nom'] ?? 'Pendiente';

                $tipoNombre = (new \App\Models\TipoPqrsModel())
                            ->find($pqrs['tipo_pqrs_id'])['nom'] ?? 'Tipo desconocido';

                $msg = "📄 *Detalle del radicado raq-{$id}*:\n"
                    . "📂 Tipo: *{$tipoNombre}*\n"
                    . "📝 Descripción: {$pqrs['descripcion']}\n"
                    . "📌 Estado: *{$estadoNombre}*";
            } else {
                $msg = "❌ No se encontró ninguna PQRS con el radicado *raq-{$id}*.";
            }

            $this->responderWhatsApp($from, $msg);
            return $this->response->setStatusCode(200);
        }


        /* ╔══════════════════════════════════════════════════════════╗
        ║ 2) FLUJO DE CREACIÓN DE PQRS (por pasos)                 ║
        ╚══════════════════════════════════════════════════════════╝ */
        if ($estado === 'esperando_tipo') {
            $tipoId = $this->getTipoId($text);
            if (!$tipoId) {
                $this->responderWhatsApp($from, "❌ Tipo no válido. Escribe Petición, Queja, Reclamo o Sugerencia.");
                return $this->response->setStatusCode(200);
            }
            $cache->save('tipo_pqrs_' . $from, $tipoId, 300);
            $cache->save('state_'     . $from, 'esperando_descripcion', 300);
            $this->responderWhatsApp($from, "📝 Escribe la descripción de tu solicitud:");
            return $this->response->setStatusCode(200);
        }

        if ($estado === 'esperando_descripcion') {
            $tipoId    = $cache->get('tipo_pqrs_' . $from);
            $usuarioId = $this->getOrCreateUsuario($from);

            $id = (new \App\Models\PqrsModel())->insert([
                'descripcion'        => $text,
                'comentario_respuesta'=> null,
                'tipo_pqrs_id'       => $tipoId,
                'usuario_id'         => $usuarioId,
                'estado_pqrs_id'     => $this->getEstadoInicialId()
            ]);

            // limpiar cache de conversación
            $cache->delete('state_'      . $from);
            $cache->delete('tipo_pqrs_'  . $from);

            $radicado = 'raq-' . $id;
            $this->responderWhatsApp(
                $from,
                "✅ Tu solicitud ha sido registrada exitosamente.\n"
            . "📄 Número de radicado: *{$radicado}*.\n"
            . "Gracias por escribirnos."
            );
            return $this->response->setStatusCode(200);
        }

        /* ╔══════════════════════════════════════════════════════════╗
        ║ 3) MENÚ PRINCIPAL Y OPCIONES RÁPIDAS                     ║
        ╚══════════════════════════════════════════════════════════╝ */
        switch ($text) {
            case '1':   // FAQ
                $faq  = "📌 *Preguntas Frecuentes de Innovatech*:\n\n";
                $faq .= "1️⃣ *¿Cuánto tarda el envío?*\nEntre 2 y 5 días hábiles.\n\n";
                $faq .= "2️⃣ *¿Cuál es el horario de atención?*\nL-V 8 a 6 & Sáb 8 a 1.\n\n";
                $faq .= "3️⃣ *¿Qué métodos de pago aceptan?*\nTarjetas, PSE y transferencias.\n\n";
                $faq .= "4️⃣ *¿Ofrecen garantía?*\nSí, mínimo 6 meses.\n\n";
                $faq .= "5️⃣ *¿Puedo recoger en tienda física?*\nSolo ventas en línea.\n\n";
                $faq .= "✏️ Escribe *menu* para volver.";
                $this->responderWhatsApp($from, $faq);
                break;

            case '2':   // Iniciar PQRS
                $cache->save('state_' . $from, 'esperando_tipo', 300);
                $this->responderWhatsApp(
                    $from,
                    "📋 ¿Qué tipo de PQRS deseas registrar?\n"
                . "(Petición, Queja, Reclamo o Sugerencia)"
                );
                break;

            case '3':   // Consulta guía
                $this->responderWhatsApp(
                    $from,
                    "🔍 Para consultar el estado de tu PQRS, escribe el número de radicado que recibiste (ej. *raq-15*)."
                );
                break;

            case '4':
                $this->responderWhatsApp(
                    $from,
                    "🛒 Productos destacados:\n• Laptop Lenovo i5\n• Router TP-Link\n• Cámara WiFi 360°\n\nVisítanos para más."
                );
                break;

            case '5':
                $this->responderWhatsApp($from, "👨‍💻 Un asesor se comunicará contigo pronto. Escribe *menu* para volver.");
                break;

            case '6':
                $this->responderWhatsApp($from, "👋 ¡Gracias por contactar a Innovatech! Hasta pronto.");
                break;

            default:
                $menu  = "👋 ¡Hola! Gracias por contactar a *Innovatech*.\n";
                $menu .= "Selecciona una opción:\n\n";
                $menu .= "1️⃣ Preguntas frecuentes\n";
                $menu .= "2️⃣ Realizar una PQRS\n";
                $menu .= "3️⃣ Consultar estado de una PQRS\n";
                $menu .= "4️⃣ Ver productos disponibles\n";
                $menu .= "5️⃣ Hablar con un asesor\n";
                $menu .= "6️⃣ Salir";
                $this->responderWhatsApp($from, $menu);
        }

        return $this->response->setStatusCode(200);
    }

    private function responderWhatsApp($telefono, $mensaje)
    {
        $token = 'EAAf2q2ZBg2qMBO6aBZBwcyengQ1nLefaT7sF3QIEoHtRmiZApB1LV7dapIY6fgQfODX476OlpoO78xLXvT1bWTVdZBsi3bn0vN9dKihoAnjUlHHlghwV0W5bRegOJ8TQmLujJUCRuQ2PS6oGpPZAW6GjZCZCfZBXTlXHU6aWJaEifquXcLIzZBlhtehINxzDdYpm0xByVI9CZCUaFJU9v0RGqTALFE3tTWfCZArXO2rwES8lbIWZAwZDZD'; // ⚠️ Reemplaza con tu token real
        $phoneId = '658480727356693'; // ✅ ID de número de teléfono de prueba

        $url = "https://graph.facebook.com/v19.0/$phoneId/messages";

        $client = \Config\Services::curlrequest();
        $response = $client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'messaging_product' => 'whatsapp',
                'to' => $telefono,
                'type' => 'text',
                'text' => ['body' => $mensaje]
            ]
        ]);

        log_message('info', '✅ Respuesta enviada a ' . $telefono . ': ' . $mensaje);
    }
   private function getOrCreateUsuario($telefono)
    {
        $usuarioModel = new \App\Models\UsuarioModel();

        // Usamos telefono1 en lugar de telefono
        $usuario = $usuarioModel->where('telefono1', $telefono)->first();

        if ($usuario) {
            return $usuario['id_usuario']; // ← importante: la PK es id_usuario
        }

        // Si no existe, lo creamos
        return $usuarioModel->insert([
            'primer_nombre'     => 'WhatsApp',
            'primer_apellido'   => 'User',
            'correo'            => $telefono . '@wa.com',
            'telefono1'         => $telefono,
            'tipo_documento_id' => 1, // Ajusta según lo que tengas por defecto
            'ciudad_id'         => 1,
            'rol_id'            => 3,
            'estado_usuario_id' => 1,
            'usuario'           => $telefono,
            'password'          => password_hash('123456', PASSWORD_DEFAULT),
        ]);
    }
    private function getTipoId($nombre)
    {
        $map = [
            'peticion' => 1,
            'queja'    => 2,
            'reclamo'  => 3,
            'sugerencia' => 4
        ];
        return $map[$nombre] ?? null;
    }

    private function getEstadoInicialId()
    {
        return 1; // Por ejemplo, "pendiente"
    }

}
