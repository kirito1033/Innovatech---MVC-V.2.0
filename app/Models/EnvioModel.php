<?php

namespace App\Models;

use CodeIgniter\Model;

class EnvioModel extends Model
{
    protected $table            = 'envio';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'direccion', 'fecha', 'estado_envio_id', 'usuario_id','numero',  'correo',   'correo_estado_enviado' ,'updated_at' 
    ];


    protected bool $allowEmptyInserts = false;


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // app/Models/EnvioModel.php

  public function verificarEstados()
    {
        $estadoEnvioModel = new \App\Models\EstadoEnvioModel();
        $emailService = \Config\Services::email();

        $envios = $this->where('correo_estado_enviado', 0)->findAll();

        foreach ($envios as $envio) {
            $estadoActual = $estadoEnvioModel->find($envio['estado_envio_id']);

            if ($estadoActual && !empty($envio['correo'])) {
                $estadoNombre = $estadoActual['nom'];
                $linkFactura = 'http://localhost:8080/facturas/pdf/' . $envio['numero'];

                $emailService->setFrom('innovatechdynamic@gmail.com', 'Innovatech');
                $emailService->setTo($envio['correo']);
                $emailService->setSubject("📦 Tu envío {$envio['numero']} ha sido actualizado");

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
