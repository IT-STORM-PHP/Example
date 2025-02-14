<?php

namespace Database\Migrations;

use App\Schema\Blueprint;
use App\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $table = new Blueprint('users');
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('password');
        $table->timestamps();
        $this->executeSQL($table->getSQL());
    }

    public function down()
    {
        $table = new Blueprint('users');
        $this->executeSQL($table->dropSQL());
    }
}
