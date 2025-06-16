<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\DepartamentoModel;
use App\Models\EstadoUsuarioModel;
use App\Models\RolModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TipoDocumentoModel;
use App\Models\CiudadModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UsuarioController extends Controller
{
    private $primaryKey;
    private $UsuarioModel;
    private $data;
    private $model;

    
    public function __construct()
    {
        $this->primaryKey = "id_usuario";
        $this->UsuarioModel = new UsuarioModel();
        $this->data = [];
        $this->model = "UsuarioModel";
    }

    public function index()
    {
        $this->data['title'] = "Usuarios";
         $rolId = session()->get('rol_id');
        $modelosModel = new \App\Models\ModelosModel();

        // Obtener los módulos permitidos para el rol actual
        $modulosPermitidos = $modelosModel->getModelosByRol($rolId);

        // Agregar los módulos a los datos enviados a la vista
        $this->data['modulos'] = $modulosPermitidos;
        $this->data[$this->model] = $this->UsuarioModel->orderBy($this->primaryKey, 'ASC')->findAll();
        
        $TipoDocumento = new TipoDocumentoModel();
        $Ciudad  = new CiudadModel();
        $Rol = new RolModel();
        $EstadoUsuario = new EstadoUsuarioModel();
        $Departamentos  = new DepartamentoModel();
        
        $this->data['Rol'] = $Rol->findAll();
        $this->data['EstadoUsuario'] = $EstadoUsuario->findAll();
        $this->data['TipoDocumento'] = $TipoDocumento->findAll();
          $this->data['Departamentos'] = $Departamentos->findAll();
        $this->data['Ciudad'] = $Ciudad->findAll();
        
        return view('usuario/usuario_view', $this->data);
    }

    public function create()
    {
        
        $isAjax = $this->request->isAJAX();
        $dataModel = $this->getDataModel();
    
        if ($this->UsuarioModel->insert($dataModel)) {
            if ($isAjax) {
                return $this->response->setJSON([
                    'message' => 'success',
                    'response' => ResponseInterface::HTTP_OK,
                    'data' => $dataModel,
                    'csrf' => csrf_hash()
                ]);
            } else {
                // Redirigir según el rol_id
                $rolId = $dataModel['rol_id'];
    
                if ($rolId == 3) {
                    return view('usuario/login');
                } elseif ($rolId == 1) {
                    return redirect()->to('/usuario')->with('success', 'Usuario creado exitosamente');
                } else {
                    return redirect()->to('/')->with('success', 'Usuario creado con un rol no reconocido');
                }
            }
        } else {
            if ($isAjax) {
                return $this->response->setJSON([
                    'message' => 'Error al crear usuario',
                    'response' => ResponseInterface::HTTP_NO_CONTENT,
                    'data' => ''
                ]);
            } else {
                return redirect()->back()->with('error', 'Error al crear usuario')->withInput();
            }
        }
    }

    public function singleUsuario($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($data[$this->model] = $this->UsuarioModel->where($this->primaryKey, $id)->first()) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al obtener usuario';
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
                $data['data'] = '';
            }
        } else {
            $data['message'] = 'Error Ajax';
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data'] = '';
        }
        echo json_encode($data);
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar($this->primaryKey);
            $dataModel = $this->getDataModel();
            if ($this->UsuarioModel->update($id, $dataModel)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = $dataModel;
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al actualizar usuario';
                $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
                $data['data'] = '';
            }
        } else {
            $data['message'] = 'Error Ajax';
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data'] = '';
        }
        echo json_encode($data);
    }

    public function delete($id = null)
    {
        try {
            if ($this->UsuarioModel->where($this->primaryKey, $id)->delete($id)) {
                $data['message'] = 'success';
                $data['response'] = ResponseInterface::HTTP_OK;
                $data['data'] = 'OK';
                $data['csrf'] = csrf_hash();
            } else {
                $data['message'] = 'Error al eliminar usuario';
                $data['response'] = ResponseInterface::HTTP_CONFLICT;
                $data['data'] = 'error';
            }
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            $data['response'] = ResponseInterface::HTTP_CONFLICT;
            $data['data'] = 'Error';
        }
        echo json_encode($data);
    }

    public function getDataModel()
    {
        
        return [
            'primer_nombre' => $this->request->getVar('primer_nombre'),
            'segundo_nombre' => $this->request->getVar('segundo_nombre') ?: null,
            'primer_apellido' => $this->request->getVar('primer_apellido'),
            'segundo_apellido' => $this->request->getVar('segundo_apellido'?: null),
            'documento' => $this->request->getVar('documento'),
            'correo' => $this->request->getVar('correo'),
            'telefono1' => $this->request->getVar('telefono1'),
            'telefono2' => $this->request->getVar('telefono2')?: null,
            'direccion' => $this->request->getVar('direccion'),
            'usuario' => $this->request->getVar('usuario'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'tipo_documento_id' => $this->request->getVar('tipo_documento_id'),
            'ciudad_id' => $this->request->getVar('ciudad_id'),
            'rol_id' => $this->request->getVar('rol_id'),
            'estado_usuario_id' => $this->request->getVar('estado_usuario_id'),
            'updated_at' => date("Y-m-d H:i:s")
        ];
    }
    public function login()
    {
        $usuario = $this->request->getVar('usuario');
        $password = $this->request->getVar('password');

        $user = $this->UsuarioModel->where('usuario', $usuario)->first();

        // Verifica si el usuario existe y la contraseña es correcta
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->handleLoginError('Usuario o contraseña incorrectos');
        }

        // Verifica si el usuario está activo (estado == 1)
        if ((int)$user['estado_usuario_id'] !== 1) {
            return $this->handleLoginError('Tu cuenta está inactiva o suspendida');
        }

        $key = getenv('JWT_SECRET') ?? 'clave_secreta_demo';
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'uid' => $user['id_usuario'],
            'usuario' => $user['usuario'],
            'rol_id' => $user['rol_id']
        ];

        $token = JWT::encode($payload, $key, 'HS256');

        session()->set([
            'token' => $token,
            'usuario' => $user['usuario'],
            'rol_id' => $user['rol_id'],
            'id_usuario' => $user['id_usuario'],
            'isLoggedIn' => true,
            'estado_usuario_id' => $user['estado_usuario_id'], // Opcional: guardar también el estado por si se quiere usar después
        ]);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Autenticación exitosa',
                'token' => $token,
                'redirect' => $user['rol_id'] == 1 ? '/admin/dasboard' : '/',
                'user' => [
                    'id' => $user['id_usuario'],
                    'usuario' => $user['usuario'],
                    'rol_id' => $user['rol_id'],
                ]
            ]);
        } else {
            return redirect()->to($user['rol_id'] == 1 ? '/usuario' : '/home');
        }
    }

// Función auxiliar para manejar errores de login
private function handleLoginError($message)
{
    if ($this->request->isAJAX()) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => $message
        ])->setStatusCode(401);
    } else {
        return redirect()->back()->with('error', $message);
    }
}

    public function logout()
    {
        // Destruye toda la sesión
        session()->destroy();

        // Si es una petición AJAX, retorna JSON
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Sesión cerrada correctamente'
            ]);
        } else {
            // Si no es AJAX, redirecciona al login
            return redirect()->to('usuario/login')->with('message', 'Sesión cerrada');
        }
    }

    public function registerView()
    {
        $TipoDocumento = new TipoDocumentoModel();
        $Ciudad  = new CiudadModel();
        $Rol = new RolModel();
        $EstadoUsuario = new EstadoUsuarioModel();
        $this->data['Rol'] = $Rol->findAll();
        $this->data['EstadoUsuario'] = $EstadoUsuario->findAll();
        $this->data['TipoDocumento'] = $TipoDocumento->findAll();
        $this->data['Ciudad'] = $Ciudad->findAll();

         return view('usuario/register', $this->data);
    }
    public function updateImage()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $img = $this->request->getFile('imagen');
    
            if ($img && $img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $img->move(ROOTPATH . 'public/uploads/', $newName);
    
                $data = [
                    'imagen' => $newName,
                    'updated_at' => date("Y-m-d H:i:s")
                ];
    
                if ($this->productosModel->update($id, $data)) {
                    return $this->response->setJSON([
                        'message' => 'success',
                        'image' => $newName,
                        'csrf' => csrf_hash()
                    ]);
                } else {
                    return $this->response->setJSON([
                        'message' => 'Error al actualizar imagen',
                        'csrf' => csrf_hash()
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'message' => 'Imagen inválida',
                    'csrf' => csrf_hash()
                ]);
            }
        }
    
        return $this->response->setJSON([
            'message' => 'No es una petición AJAX',
            'csrf' => csrf_hash()
        ]);
    }   
  
    
}