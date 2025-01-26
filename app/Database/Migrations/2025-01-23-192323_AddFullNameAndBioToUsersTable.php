<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFullNameAndBioToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'fullname' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'password', // Position after 'password'
            ],
            'bio' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'fullname', // Position after 'full_name'
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
