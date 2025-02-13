<?php

namespace Database\Migrations;

use App\Schema\Blueprint;
use App\Database\Migration;

class Ismael extends Migration
{
    public function up()
    {
        $table = new Blueprint('table_name');
        $table->id();
        $table->string('name');
        $table->timestamps();
        $this->executeSQL($table->getSQL());
    }

    public function down()
    {
        $table = new Blueprint('table_name');
        $this->executeSQL($table->dropSQL());
    }
}
