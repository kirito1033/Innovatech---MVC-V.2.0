<?php

namespace App\Controllers;

class TestEmailController extends BaseController
{
    public function index()
    {
        $email = \Config\Services::email();

        // Configura los datos del remitente y destinatario
        $email->setFrom('innovatechdynamic@gmail.com', 'Innovatech Dynamic');
        $email->setTo('so1959373@gmail.com'); // ← Cambia por tu correo real

        $email->setSubject('Correo de prueba desde CodeIgniter');
        $email->setMessage('Este es un correo de prueba enviado desde CodeIgniter 4 usando Gmail SMTP.');

        // Enviar correo y mostrar resultado
        if ($email->send()) {
            echo '✅ Correo enviado correctamente.';
        } else {
            echo '❌ Error al enviar el correo:<br><pre>';
            print_r($email->printDebugger(['headers']));
            echo '</pre>';
        }
    }
}
