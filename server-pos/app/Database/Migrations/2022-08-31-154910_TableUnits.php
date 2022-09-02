<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableUnits extends Migration
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
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->addKey('id');
		$this->forge->createTable('units');
    }

    public function down()
    {
        $this->forge->dropTable('units');
    }
}
