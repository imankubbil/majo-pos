<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [];

    public function getCustomers() {
        $query = "SELECT id, name, email, created_at, updated_at FROM {$this->table}";
        $result = $this->db->query($query);
        
        return $result->getResultObject();
    }

    public function getCustomerById($id) {
        $query = "SELECT id, name, email, created_at, updated_at FROM {$this->table} WHERE id = ?";
        $result = $this->db->query($query, [$id]);
        
        return $result->getRow();
    }

    public function addCustomer($customer) {
        $query = "INSERT INTO {$this->table}(name, email, password, created_at, updated_at)
                    VALUES ('{$customer['name']}', '{$customer['email']}', '{$customer['password']}', NOW(), NOW())";

        $result = $this->db->query($query);
        return $result;
    }

    public function updateCustomer($id, $customer) {
        return $this->db->table($this->table)->update($customer, ['id' => $id]);
    }

    public function deleteCustomer($id) {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }
}
