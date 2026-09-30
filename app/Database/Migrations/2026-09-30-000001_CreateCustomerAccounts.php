<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomerAccounts extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'account_number' => ['type' => 'VARCHAR', 'constraint' => 50],
            'customer_name' => ['type' => 'VARCHAR', 'constraint' => 150],
            'address' => ['type' => 'TEXT'],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'meter_number' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'connection_type' => ['type' => 'ENUM', 'constraint' => ['residential', 'commercial', 'industrial'], 'default' => 'residential'],
            'status' => ['type' => 'ENUM', 'constraint' => ['active', 'inactive', 'suspended'], 'default' => 'active'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('account_number');
        $this->forge->addKey('status');
        $this->forge->addKey('connection_type');
        $this->forge->createTable('customer_accounts', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('customer_accounts', true);
    }
}
