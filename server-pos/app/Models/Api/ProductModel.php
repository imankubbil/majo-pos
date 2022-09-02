<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [];

    public function getProducts() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->db->query($query);
        
        return $result->getResultObject();
    }

    public function getProductById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $result = $this->db->query($query, [$id]);
        
        return $result->getRow();
    }

    public function addProduct($product) {
        $query = "INSERT INTO {$this->table}(name, email, address, description, phone, created_at, updated_at)
                    VALUES ('{$product['name']}', '{$product['email']}', '{$product['address']}', '{$product['description']}', '{$product['phone']}', NOW(), NOW())";

        $result = $this->db->query($query);
        return $result;
    }

    public function updateProduct($id, $product) {
        return $this->db->table($this->table)->update($product, ['id' => $id]);
    }

    public function deleteProduct($id) {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }
}
