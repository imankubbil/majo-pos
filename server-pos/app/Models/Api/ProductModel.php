<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [];

    public function getProducts() {
        $query = "SELECT a.*, b.name unit_name, c.name category_name, d.name supplier_name
                    FROM {$this->table} a
                    JOIN units b ON a.unit_id = b.id
                    JOIN categories c ON a.category_id = c.id
                    JOIN suppliers d ON a.supplier_id = d.id
                 ";
        $result = $this->db->query($query);
        
        return $result->getResultObject();
    }

    public function getProductById($id) {
        $query = "SELECT a.*, b.name unit_name, c.name category_name, d.name supplier_name
                    FROM {$this->table} a
                    JOIN units b ON a.unit_id = b.id
                    JOIN categories c ON a.category_id = c.id
                    JOIN suppliers d ON a.supplier_id = d.id 
                  WHERE a.id = ?";
        $result = $this->db->query($query, [$id]);
        
        return $result->getRow();
    }

    public function addProduct($product) {
       return $this->db->table($this->table)->insert($product);
    }

    public function updateProduct($id, $product) {
        return $this->db->table($this->table)->update($product, ['id' => $id]);
    }

    public function deleteProduct($id) {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }
}
