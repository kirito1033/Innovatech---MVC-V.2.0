<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table            = 'productos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nom',
        'descripcion',
        'existencias',
        'precio',
        'imagen',
        'caracteristicas',
        'tam',
        'tampantalla',
        'id_marca',
        'id_estado',
        'id_color',
        'id_categoria',
        'id_garantia',
        'id_almacenamiento',
        'id_ram',
        'id_sistema_operativo',
        'id_resolucion',
        'precio_original',
        'updated_at'
    ];
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
    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
