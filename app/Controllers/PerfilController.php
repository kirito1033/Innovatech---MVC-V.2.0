<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\TipoDocumentoModel;
use App\Models\CategoriaModel;
use App\Models\ModelosModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\HTTP\ResponseInterface;
use Throwable;


class PerfilController extends Controller
{
    // Mostrar vista del perfil del usuario
    public function index()
    {
        $session = session();
        $idUsuario = $session->get('id_usuario');

        if (!$idUsuario) {
            return redirect()->to('/logout');
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($idUsuario);

        $modelosModel = new ModelosModel();
        $rolId = $session->get('rol_id');
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->findAll();

        return view('perfil/perfil', [
            'usuario'    => $usuario,
            'categorias' => $categorias,
            'modulos'    => $modulosPermitidos,
            'title'      => 'Mi Perfil'
        ]);
    }

    // Verificar de contraseña
    public function verificarPassword()
    {
        $session = session();
        $idUsuario = $session->get('id_usuario');

        if (!$idUsuario) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No autorizado'])->setStatusCode(401);
        }

        $json = $this->request->getJSON();
        $passwordIngresada = $json->password ?? '';

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($idUsuario);

        if (!$usuario || !password_verify($passwordIngresada, $usuario['password'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Contraseña incorrecta']);
        }

        return $this->response->setJSON(['status' => 'success']);
    }


    // Datos del usuario
    public function obtenerDatos()
    {
        $session = session();
        $idUsuario = $session->get('id_usuario');

        if (!$idUsuario) {
            return $this->response->setJSON(['error' => 'No autorizado'])->setStatusCode(401);
        }

        $usuarioModel = new \App\Models\UsuarioModel();
        $usuario = $usuarioModel->find($idUsuario);

        if (!$usuario) {
            return $this->response->setJSON(['error' => 'Usuario no encontrado'])->setStatusCode(404);
        }

        $tipoDocumentoModel = new TipoDocumentoModel();
        $tipoDoc = $tipoDocumentoModel->find($usuario['tipo_documento_id']);

        $usuario['nombre_tipo_documento'] = $tipoDoc['nom'] ?? 'Sin definir';

        return $this->response->setJSON($usuario);
    }



    // Guardar cambios de perfil del usuario
    public function actualizar()
    {
        $session = session();
        $idUsuario = $session->get('id_usuario');

        if (!$idUsuario) {
            return $this->response->setJSON(['error' => 'No autorizado'])->setStatusCode(401);
        }

        $usuarioModel = new UsuarioModel();

        // Obtener datos JSON
        $json = $this->request->getJSON();

        $data = [
            'primer_nombre'     => $json->primer_nombre     ?? null,
            'segundo_nombre'    => $json->segundo_nombre    ?? null,
            'primer_apellido'   => $json->primer_apellido   ?? null,
            'segundo_apellido'  => $json->segundo_apellido  ?? null,
            'telefono1'         => $json->telefono1         ?? null,
            'telefono2'         => $json->telefono2         ?? null,
            'direccion'         => $json->direccion         ?? null,
            'correo'            => $json->correo            ?? null,
            'usuario'           => $json->usuario           ?? null,
        ];

        // Agregar nueva contraseña si viene
        if (!empty($json->password)) {
            $data['password'] = password_hash($json->password, PASSWORD_DEFAULT);
        }
        
        $usuarioModel->update($idUsuario, $data);

        return $this->response->setJSON(['mensaje' => 'Perfil actualizado correctamente']);
    }

    // Cargar imagen
    public function updateImage()
    {
        try {
            if (!$this->request->isAJAX()) {
                return $this->response->setJSON([
                    'message'  => 'Petición inválida',
                    'response' => ResponseInterface::HTTP_BAD_REQUEST
                ]);
            }

            $session = session();
            $idUsuario = $session->get('id_usuario');

            if (!$idUsuario) {
                return $this->response->setJSON([
                    'message'  => 'No autorizado',
                    'response' => ResponseInterface::HTTP_UNAUTHORIZED
                ]);
            }

            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->asArray()->find($idUsuario);

            if (!$usuario) {
                return $this->response->setJSON([
                    'message'  => 'Usuario no encontrado',
                    'response' => ResponseInterface::HTTP_NOT_FOUND
                ]);
            }

            $img = $this->request->getFile('foto_perfil');

            if (!$img) {
                return $this->response->setJSON([
                    'message' => 'No se recibió el archivo',
                    'response' => ResponseInterface::HTTP_BAD_REQUEST
                ]);
            }

            if (!$img->isValid()) {
                return $this->response->setJSON([
                    'message' => 'Archivo inválido',
                    'error_code' => $img->getError(),
                    'error_detail' => $img->getErrorString(),
                    'response' => ResponseInterface::HTTP_BAD_REQUEST
                ]);
            }

            $allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower($img->getExtension());

            if (!in_array($ext, $allowedTypes)) {
                return $this->response->setJSON([
                    'message' => 'Tipo de archivo no permitido',
                    'ext' => $ext,
                    'response' => ResponseInterface::HTTP_UNSUPPORTED_MEDIA_TYPE
                ]);
            }

            $newName = $img->getRandomName();
            $uploadPath = ROOTPATH . 'public/uploads/perfiles/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if (!empty($usuario['foto_perfil']) && $usuario['foto_perfil'] !== 'profile.jpg') {
                $oldImagePath = $uploadPath . $usuario['foto_perfil'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            if (!$img->hasMoved()) {
                $img->move($uploadPath, $newName);
            }

            if ($usuario['foto_perfil'] !== $newName) {
                $usuarioModel->update($idUsuario, ['foto_perfil' => $newName]);
            }

            return $this->response->setJSON([
                'message'  => 'success',
                'foto_perfil' => $newName,
                'response' => ResponseInterface::HTTP_OK,
                'csrf'     => csrf_hash()
            ]);

        } catch (Throwable $e) {
            return $this->response->setJSON([
                'message' => 'Error interno: ' . $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'trace'   => $e->getTraceAsString(),
                'response' => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

}