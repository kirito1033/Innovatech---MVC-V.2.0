<?php

namespace App\Models;

use CodeIgniter\Model;


/**
 * Modelo ProductosModel
 *
 * Este modelo gestiona la tabla 'productos' y proporciona una función
 * para recuperar un producto con todas sus relaciones asociadas (color, marca,
 * categoría, almacenamiento, RAM, sistema operativo y resolución).
 */
class ProductosModel extends Model
{
    //Nombre de la tabla en la base de datos.
    protected $table            = 'productos';
    //Llave primaria de la tabla.
    protected $primaryKey       = 'id';
    // Determina si se usa autoincremento en la llave primaria.
    protected $useAutoIncrement = true;
    //Tipo de retorno (array de resultados).
    protected $returnType       = 'array';
    //Indica si se utilizan eliminaciones suaves (soft deletes).
    protected $useSoftDeletes   = false;
    //Determina si se protegen los campos contra inserciones masivas no permitidas.
    protected $protectFields    = true;
    //Lista de campos permitidos para inserción y actualización masiva.
    protected $allowedFields    = [
        'nom', // Nombre del producto
        'descripcion', // Descripción del producto
        'existencias', // Existencias disponibles
        'precio', // Precio actual
        'imagen', // URL o nombre del archivo de imagen
        'caracteristicas', // Características adicionales
        'tam', // Tamaño físico del producto
        'tampantalla', // Tamaño de la pantalla
        'id_marca', // Relación con la tabla marca
        'id_estado', // Relación con la tabla estado
        'id_color', // Relación con la tabla color
        'id_categoria', // Relación con la tabla categoría
        'id_garantia', // Relación con la tabla garantía
        'id_almacenamiento', // Relación con la tabla almacenamiento
        'id_ram', // Relación con la tabla de memoria RAM
        'id_sistema_operativo', // Relación con la tabla sistema operativo
        'id_resolucion', // Relación con la tabla resolución de pantalla
        'precio_original', // Precio original (antes de descuentos)
        'updated_at' // Fecha de última actualización
    ];
 
    // Obtiene un producto por su ID incluyendo relaciones descriptivas.
    public function getProductoConRelaciones($id)
    {
        return $this->select('
                productos.*,
                color.nom as color,
                marca.nom as marca,
                categoria.nom as categoria,
                CONCAT(almacenamiento.num, " ", almacenamiento.unidadestandar) as almacenamiento,
                CONCAT(almacenamiento_aleatorio.num, " ", almacenamiento_aleatorio.unidadestandar) as ram,
                sistema_operativo.nom as sistema_operativo,
                resolucion.nom as resolucion
            ')
            ->join('color', 'color.id_color = productos.id_color', 'left')
            ->join('marca', 'marca.id = productos.id_marca', 'left')
            ->join('categoria', 'categoria.id = productos.id_categoria', 'left')
            ->join('almacenamiento', 'almacenamiento.id = productos.id_almacenamiento', 'left')
            ->join('almacenamiento_aleatorio', 'almacenamiento_aleatorio.id = productos.id_ram', 'left')
            ->join('sistema_operativo', 'sistema_operativo.id = productos.id_sistema_operativo', 'left')
            ->join('resolucion', 'resolucion.id = productos.id_resolucion', 'left')
            ->find($id);
    }

    //Evita que se inserten registros con todos los campos vacíos.
    protected bool $allowEmptyInserts = false;

    // Activa el manejo automático de fechas (created_at y updated_at).
    protected $useTimestamps = true;
    //Campo que se llenará automáticamente al crear un registro.
    protected $createdField  = 'created_at';
    //Campo que se actualizará automáticamente al modificar un registro.
    protected $updatedField  = 'updated_at';
}
