<?php

namespace Database\Migrations;

use App\Schema\Blueprint;
use App\Database\Migration;

class Auteurs extends Migration
{
    public function up()
    {
        $table = new Blueprint('autheurs');
        $table->id();
        $table->string('nom');
        $table->string("prenom");
        $table->timestamps();
        $this->executeSQL($table->getSQL());
    }

    public function down()
    {
        $table = new Blueprint('table_name');
        $this->executeSQL($table->dropSQL());
    }
}
