<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\I18n\Time;

class AuthController extends BaseController
{
    public function showForgotForm()
    {
        return view('auth/forgot_password');
    }

   public function sendResetLink()
{
    $correo = $this->request->getPost('correo');

    $usuarioModel = new UsuarioModel();
    $usuario = $usuarioModel->where('correo', $correo)->first();

    if (!$usuario) {
        return redirect()->back()->with('error', 'Correo no encontrado');
    }

    $token = bin2hex(random_bytes(32));
    $expira = Time::now()->addMinutes(30);

    $usuarioModel->update($usuario['id_usuario'], [
        'reset_token' => $token,
        'reset_token_expiration' => $expira
    ]);

    // Enlace para restablecer la contraseña
    $resetLink = base_url("reset-password/$token");

    // Cuerpo del correo con HTML y estilos
    $mensajeHTML = '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Recuperación de contraseña</title>
    </head>
    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
        <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); padding: 30px;">
            <h2 style="color: #0a6069;">Recuperación de contraseña</h2>
            <p>Hola ' . htmlspecialchars($usuario['primer_nombre']) . ',</p>
            <p>Hemos recibido una solicitud para restablecer tu contraseña. Haz clic en el botón de abajo para continuar:</p>
            <p style="text-align: center;">
                <a href="' . $resetLink . '" style="display: inline-block; padding: 12px 25px; background-color: #048d94; color: #ffffff; text-decoration: none; border-radius: 5px;">Restablecer contraseña</a>
            </p>
            <p>Si tú no solicitaste este cambio, puedes ignorar este mensaje.</p>
            <p style="color: #888;">Este enlace estará disponible durante los próximos 30 minutos.</p>
            <hr style="border: none; border-top: 1px solid #ddd;">
            <p style="font-size: 12px; color: #aaa;">Innovatech Dynamic - Todos los derechos reservados</p>
        </div>
    </body>
    </html>
    ';

    // Enviar correo
    $email = service('email');
    $email->setTo($correo);
    $email->setSubject('Recuperar contraseña');
    $email->setMessage($mensajeHTML);
    $email->send();

    return redirect()->back()->with('success', 'Revisa tu correo para continuar.');
}


    public function showResetForm($token)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where('reset_token', $token)
            ->where('reset_token_expiration >=', Time::now())
            ->first();

        if (!$usuario) {
            return view('auth/token_invalid');
        }

        return view('auth/reset_password', ['token' => $token]);
    }

    public function updatePassword()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where('reset_token', $token)
            ->where('reset_token_expiration >=', Time::now())
            ->first();

        if (!$usuario) {
            return view('auth/token_invalid');
        }

        $usuarioModel->update($usuario['id_usuario'], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_token_expiration' => null
        ]);

        return redirect()->to('usuario/login')->with('success', 'Contraseña actualizada. Inicia sesión.');
    }
}
