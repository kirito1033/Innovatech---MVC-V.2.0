<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo para gestionar la tabla 'envio'.
 * 
 * Este modelo permite realizar operaciones CRUD sobre los registros de envío, 
 * incluyendo datos del destinatario, estado del envío, y el control del correo enviado.
 * Además, contiene un método personalizado para verificar el estado de los envíos y
 * notificar al usuario por correo electrónico si hay actualizaciones.
 */
class EnvioModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table            = 'envio';
    // Clave primaria de la tabla
    protected $primaryKey       = 'id';
    // Indica que la clave primaria se incrementa automáticamente
    protected $useAutoIncrement = true;
    // Define el formato del resultado devuelto: array asociativo
    protected $returnType       = 'array';
    // No se utiliza borrado lógico
    protected $useSoftDeletes   = false;
    // Protección contra asignación masiva
    protected $protectFields    = true;
    // Campos que pueden ser insertados o actualizados
    protected $allowedFields    = [
        'direccion', 'fecha', 'estado_envio_id', 'usuario_id','numero',  'correo',   'correo_estado_enviado' ,'updated_at' 
    ];

    // No se permite insertar registros vacíos
    protected bool $allowEmptyInserts = false;

    // Manejo automático de timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

      /**
     * Verifica los envíos cuyo estado ha cambiado y no han sido notificados por correo.
     * 
     * Este método consulta los registros con `correo_estado_enviado = 0`, obtiene el estado
     * actual desde el modelo `EstadoEnvioModel`, y si hay un correo electrónico disponible,
     * envía una notificación con el nuevo estado y un enlace a la factura PDF.
     * 
     * Después de enviar el correo exitosamente, actualiza el campo `correo_estado_enviado` a 1.
     */

  public function verificarEstados()
    {
        // Modelo para obtener el nombre del estado del envío
        $estadoEnvioModel = new \App\Models\EstadoEnvioModel();
        // Servicio de correo de CodeIgniter
        $emailService = \Config\Services::email();

        // Obtener todos los envíos que no han sido notificados
        $envios = $this->where('correo_estado_enviado', 0)->findAll();

        foreach ($envios as $envio) {
            // Buscar el estado actual del envío
            $estadoActual = $estadoEnvioModel->find($envio['estado_envio_id']);

            if ($estadoActual && !empty($envio['correo'])) {
                $estadoNombre = $estadoActual['nom'];
                $linkFactura = 'https://rosybrown-ape-589569.hostingersite.com/facturas/pdf/' . $envio['numero'];

                // Configurar el correo
                $emailService->setFrom('innovatechdynamic@gmail.com', 'Innovatech');
                $emailService->setTo($envio['correo']);
                $emailService->setSubject("📦 Tu envío {$envio['numero']} ha sido actualizado");

                 // Contenido del mensaje en HTML
                $mensaje = '
                    <div style="font-family: Arial, sans-serif; background-color: #f5f5f5; padding: 40px;">
                        <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                            <div style="background-color: #0f838c; color: #fff; padding: 20px;">
                                <h2 style="margin: 0;">Innovatech</h2>
                                <p style="margin: 5px 0 0;">Estado de tu envío</p>
                            </div>
                            <div style="padding: 30px;">
                                <h3 style="color: #333;">Hola,</h3>
                                <p style="color: #555;">Queremos informarte que el estado de tu envío ha sido actualizado:</p>

                                <table style="width: 100%; font-size: 15px; margin: 20px 0;">
                                    <tr>
                                        <td style="color: #333;"><strong>Número de envío:</strong></td>
                                        <td style="color: #0a6069;">' . $envio['numero'] . '</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #333;"><strong>Estado actual:</strong></td>
                                        <td style="color: #0a6069;">' . $estadoNombre . '</td>
                                    </tr>
                                </table>

                                <p style="color: #555;">Puedes ver tu factura en el siguiente enlace:</p>
                                <p>
                                    <a href="' . $linkFactura . '" style="background-color: #04ebec; color: #000; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block; font-weight: bold;">
                                        Ver Factura PDF
                                    </a>
                                </p>

                                <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">

                                <p style="font-size: 12px; color: #888;">Este es un mensaje automático. Por favor, no respondas a este correo.</p>
                            </div>
                        </div>
                    </div>
                ';

                $emailService->setMessage($mensaje);
                $emailService->setMailType('html');

                // Enviar el correo y registrar el resultado
                if ($emailService->send()) {
                    log_message('info', "📧 Correo enviado a {$envio['correo']} para envío {$envio['numero']} con estado {$estadoNombre}");
                    $this->update($envio['id'], ['correo_estado_enviado' => 1]);
                } else {
                    log_message('error', "❌ Error al enviar correo a {$envio['correo']}: " . $emailService->printDebugger(['headers']));
                }
            }
        }

        return true;
    }




}
