<?php
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase {

    public function testLoginSuccess() {
        // Simular ingreso de usuario válido
        $email = 'so1959373@gmail.com';
        $password = 'Sebas123#';

        // Llamada al método de login del modelo
        $userModel = new UserModel();
        $result = $userModel->login($email, $password);

        $this->assertTrue($result['success']);
        $this->assertEquals('Dashboard', $result['redirect']);
    }

    public function testLoginFailure() {
        $email = 'invalido@ejemplo.com';
        $password = 'abcde';

        $userModel = new UserModel();
        $result = $userModel->login($email, $password);

        $this->assertFalse($result['success']);
        $this->assertEquals('Credenciales inválidas', $result['message']);
    }
}
