<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admins';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [];

    public function getAdmins() {
        $query = "SELECT id, name, email, created_at, updated_at FROM {$this->table}";
        $result = $this->db->query($query);
        
        return $result->getResultObject();
    }

    public function getAdminById($id) {
        $query = "SELECT id, name, email, created_at, updated_at FROM {$this->table} WHERE id = ?";
        $result = $this->db->query($query, [$id]);
        
        return $result->getRow();
    }

    public function getAdminByEmail($email) {
        $query = "SELECT * FROM {$this->table} WHERE email = ?";
        $result = $this->db->query($query, [$email]);
        
        return $result->getRow();
    }

    public function addAdmin($admin) {
        $query = "INSERT INTO {$this->table}(name, email, password, created_at, updated_at)
                    VALUES ('{$admin['name']}', '{$admin['email']}', '{$admin['password']}', NOW(), NOW())";

        $result = $this->db->query($query);
        return $result;
    }

    public function updateAdmin($id, $admin) {
        return $this->db->table($this->table)->update($admin, ['id' => $id]);
    }

    public function deleteAdmin($id) {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }
}
