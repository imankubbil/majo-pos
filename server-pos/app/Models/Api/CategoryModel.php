<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [];

    public function getCategories() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->db->query($query);
        
        return $result->getResultObject();
    }

    public function getCategoryById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $result = $this->db->query($query, [$id]);
        
        return $result->getRow();
    }

    public function addCategory($category) {
        $query = "INSERT INTO {$this->table}(name, description, created_at, updated_at)
                    VALUES ('{$category['name']}', '{$category['description']}', NOW(), NOW())";

        $result = $this->db->query($query);
        return $result;
    }

    public function updateCategory($id, $category) {
        return $this->db->table($this->table)->update($category, ['id' => $id]);
    }

    public function deleteCategory($id) {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }
}
