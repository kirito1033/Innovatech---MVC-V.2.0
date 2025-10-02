<?php
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {

    public function testCreateProduct() {
        $productModel = new ProductModel();
        $data = [
            'nombre' => 'Laptop XYZ',
            'marca' => 'Dell',
            'modelo' => 'Inspiron 15',
            'categoria' => 'Computadores',
            'precio' => 1500000
        ];

        $result = $productModel->create($data);

        $this->assertTrue($result);
        $this->assertDatabaseHas('productos', ['nombre' => 'Laptop XYZ']);
    }
}
