<?php

namespace App\Controllers;

/**
 * Controlador para probar el envío de correos electrónicos
 * utilizando el servicio de Email de CodeIgniter 4.
 */
class TestEmailController extends BaseController
{
    /**
     * Envía un correo de prueba a una dirección específica.
     * 
     * Configura los parámetros básicos como remitente, destinatario,
     * asunto y cuerpo del mensaje. Luego intenta enviarlo y muestra
     * el resultado directamente en el navegador.
     */
    public function index()
    {
        // Cargar el servicio de email configurado en Config/Email.php
        $email = \Config\Services::email();

        // Configura los datos del remitente y destinatario
        $email->setFrom('innovatechdynamic@gmail.com', 'Innovatech Dynamic');
        $email->setTo('so1959373@gmail.com'); // ← Reemplazar por tu correo real para pruebas

        // Asunto y contenido del mensaje
        $email->setSubject('Correo de prueba desde CodeIgniter');
        $email->setMessage('Este es un correo de prueba enviado desde CodeIgniter 4 usando Gmail SMTP.');

        // Intentar enviar el correo
        if ($email->send()) {
            echo '✅ Correo enviado correctamente.';
        } else {
            // Mostrar detalles de error si falla el envío
            echo '❌ Error al enviar el correo:<br><pre>';
            print_r($email->printDebugger(['headers']));
            echo '</pre>';
        }
    }
}
