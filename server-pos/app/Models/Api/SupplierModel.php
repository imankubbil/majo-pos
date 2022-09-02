<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table            = 'suppliers';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [];

    public function getSuppliers() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->db->query($query);
        
        return $result->getResultObject();
    }

    public function getSupplierById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $result = $this->db->query($query, [$id]);
        
        return $result->getRow();
    }

    public function addSupplier($supplier) {
        $query = "INSERT INTO {$this->table}(name, email, address, description, phone, created_at, updated_at)
                    VALUES ('{$supplier['name']}', '{$supplier['email']}', '{$supplier['address']}', '{$supplier['description']}', '{$supplier['phone']}', NOW(), NOW())";

        $result = $this->db->query($query);
        return $result;
    }

    public function updateSupplier($id, $supplier) {
        return $this->db->table($this->table)->update($supplier, ['id' => $id]);
    }

    public function deleteSupplier($id) {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }
}
