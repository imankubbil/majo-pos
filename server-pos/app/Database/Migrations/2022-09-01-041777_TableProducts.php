<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableProducts extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id' => [
				'type' => 'BIGINT',
				'constraint' => 12,
				'unsigned' => true,
				'auto_increment' => true
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 35,
			],
			'description' => [
				'type' => 'TEXT',
				'null' => false
			],
			'price' => [
				'type' => 'int',
				'constraint' => 11,
			],
			'picture' => [
				'type' => 'VARCHAR',
				'constraint' => 155
            ],
			'unit_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
			'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
			'supplier_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->addKey('id');
		$this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
