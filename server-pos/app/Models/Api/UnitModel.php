<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table            = 'units';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [];

    public function getUnits() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->db->query($query);
        
        return $result->getResultObject();
    }

    public function getUnitById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $result = $this->db->query($query, [$id]);
        
        return $result->getRow();
    }

    public function addUnit($unit) {
        $query = "INSERT INTO {$this->table}(name, description, created_at, updated_at)
                    VALUES ('{$unit['name']}', '{$unit['description']}', NOW(), NOW())";

        $result = $this->db->query($query);
        return $result;
    }

    public function updateUnit($id, $unit) {
        return $this->db->table($this->table)->update($unit, ['id' => $id]);
    }

    public function deleteUnit($id) {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }
}
