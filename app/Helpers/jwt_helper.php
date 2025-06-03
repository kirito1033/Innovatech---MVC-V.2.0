<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generarToken($datos)
{
    $clave = getenv('JWT_SECRET');
    $payload = [
        'iat' => time(),
        'exp' => time() + (60 * 60), // 1 hora de duración
        'data' => $datos
    ];

    return JWT::encode($payload, $clave, 'HS256');
}

function verificarToken($token)
{
    try {
        $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
        return (array) $decoded->data;
    } catch (Exception $e) {
        return false;
    }
}
