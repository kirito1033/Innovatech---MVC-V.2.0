<?php

namespace App\Models;

use CodeIgniter\Model;


/**
 * Modelo para interactuar con la tabla `pedido`.
 *
 * Este modelo gestiona los pedidos realizados por los usuarios,
 * incluyendo la fecha, el valor total y el identificador del usuario asociado.
 */
class PedidoModel extends Model
{
    //Nombre de la tabla asociada en la base de datos.
    protected $table            = 'pedido';
    //Nombre de la llave primaria.
    protected $primaryKey       = 'id';
    //Habilita el autoincremento de la clave primaria.
    protected $useAutoIncrement = true;
    //Tipo de datos devuelto por las consultas (array u objeto).
    protected $returnType       = 'array';
    //Habilita o deshabilita el borrado lógico.
    protected $useSoftDeletes   = false;
    //Protege los campos contra asignación masiva.
    protected $protectFields    = true;
    
    //Campos que se pueden insertar o actualizar de forma segura.
    protected $allowedFields    = [
        'fecha', // Fecha en que se realiza el pedido
        'valortl', // Valor total del pedido
        'UsuarioId_usuario' // ID del usuario que realizó el pedido (clave foránea)
    ];

    //Evita inserciones con campos vacíos.
    protected bool $allowEmptyInserts = false;

    //Habilita el manejo automático de timestamps.
    protected $useTimestamps = true;
    //Campo que almacena la fecha de creación.
    protected $createdField  = 'created_at';
    //Campo que almacena la fecha de última actualización.
    protected $updatedField  = 'updated_at';


}
