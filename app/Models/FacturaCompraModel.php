<?php

namespace App\Models;

use CodeIgniter\Model;

class FacturaCompraModel extends Model
{
    protected $table      = 'facturas_compras';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'reference_code', 'factura_json', "numero"];
    protected $useTimestamps = true;

    // Total Facturas
    public function totalFacturas()
    {
        return $this->builder()->countAllResults();
    }

    // Total Productos KPIS
    public function totalProductosVendidos()
    {
        $sql = "
            SELECT SUM(
                CAST(JSON_EXTRACT(i.value, '$.quantity') AS UNSIGNED)
            ) AS total
            FROM facturas_compras f,
            JSON_TABLE(
                f.factura_json,
                '$.items[*]' COLUMNS (value JSON PATH '$')
            ) AS i
        ";

        return $this->db->query($sql)->getRow()->total ?? 0;
    }


    // Ganancias Totales
    public function totalGanancias()
    {
        $sql = "
            SELECT SUM(
                CAST(JSON_EXTRACT(i.value, '$.quantity') AS DECIMAL(10,2)) *
                CAST(JSON_EXTRACT(i.value, '$.price') AS DECIMAL(10,2))
            ) AS total
            FROM facturas_compras f,
            JSON_TABLE(
                f.factura_json,
                '$.items[*]' COLUMNS (value JSON PATH '$')
            ) AS i
        ";

        return $this->db->query($sql)->getRow()->total ?? 0;
    }


    // Ventas por mes
    public function ventasPorMes()
    {
        $sql = "
            SELECT 
                DATE_FORMAT(created_at, '%Y-%m') AS mes,
                SUM(
                    CAST(JSON_EXTRACT(i.value, '$.quantity') AS DECIMAL(10,2)) *
                    CAST(JSON_EXTRACT(i.value, '$.price') AS DECIMAL(10,2))
                ) AS total
            FROM facturas_compras f,
            JSON_TABLE(
                f.factura_json,
                '$.items[*]' COLUMNS (value JSON PATH '$')
            ) AS i
            GROUP BY mes
            ORDER BY mes
        ";

        return $this->db->query($sql)->getResultArray();
    }


    // Productos más vendidos
    public function productosMasVendidos($limit = 5)
    {
        $sql = "
            SELECT 
                JSON_EXTRACT(i.value, '$.name') AS nombre,
                SUM(
                    CAST(JSON_EXTRACT(i.value, '$.quantity') AS UNSIGNED)
                ) AS total
            FROM facturas_compras f,
            JSON_TABLE(
                f.factura_json,
                '$.items[*]' COLUMNS (value JSON PATH '$')
            ) AS i
            GROUP BY nombre
            ORDER BY total DESC
            LIMIT ?
        ";

        return $this->db->query($sql, [$limit])->getResultArray();
    }

}
