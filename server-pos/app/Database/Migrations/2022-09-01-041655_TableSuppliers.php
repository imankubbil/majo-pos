<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableSuppliers extends Migration
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
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 55,
			],
			'address' => [
				'type' => 'TEXT',
				'null' => false
            ],
			'description' => [
				'type' => 'TEXT',
				'null' => false
            ],
			'phone' => [
				'type' => 'VARCHAR',
				'constraint' => 15,
            ],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->addKey('id');
		$this->forge->createTable('suppliers');
    }

    public function down()
    {
        $this->forge->dropTable('suppliers');
    }
}
