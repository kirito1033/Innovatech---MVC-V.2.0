<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo ModelosModel
 *
 * Este modelo representa la entidad `modelos` en la base de datos y se encarga de gestionar
 * rutas y descripciones de módulos o vistas que pueden estar asociadas a roles del sistema.
 * También contiene una función personalizada para obtener los modelos asignados a un rol específico.
 */
class ModelosModel extends Model
{
   // Nombre de la tabla en la base de datos.
    protected $table            = 'modelos';
    //Clave primaria de la tabla.
    protected $primaryKey       = 'id';
    //Habilita el uso de autoincremento para la clave primaria.
    protected $useAutoIncrement = true;
    //Tipo de dato devuelto por defecto (arreglo asociativo).
    protected $returnType       = 'array';
    //No se utiliza borrado lógico.
    protected $useSoftDeletes   = false;
    //Solo los campos listados en `allowedFields` pueden ser insertados o actualizados.
    protected $protectFields    = true;
    //Lista de campos permitidos para inserción y actualización.
    protected $allowedFields    = ['Ruta', 'Descripción', 'updated_at'];

    // Impide insertar registros vacíos.
    protected bool $allowEmptyInserts = false;


    // Habilita el uso automático de campos de fecha.
    protected $useTimestamps = true;
    //Campo utilizado para almacenar la fecha de creación del registro.
    protected $createdField  = 'created_at';
    //Campo utilizado para almacenar la fecha de última actualización.
    protected $updatedField  = 'updated_at';

    //Obtiene todos los modelos (vistas/rutas) asignados a un rol específico.
   public function getModelosByRol($rolId)
    {
        return $this->db->table('modelos_rol')
            ->select('modelos.*, modelos_rol.grupo, modelos_rol.Rolid') // Asegúrate de incluir grupo
            ->join('modelos', 'modelos.id = modelos_rol.Modelosid')
            ->where('modelos_rol.Rolid', $rolId)
            ->get()
            ->getResultArray();
    }

}

// ModelosModel.php
