<?php

namespace Database\Migrations;

use App\Schema\Blueprint;
use App\Database\Migration;

class Will extends Migration
{
    public function up()
    {
        $table = new Blueprint('will');
        $table->id();
        $table->string('name');
        $table->timestamps();
        $this->executeSQL($table->getSQL());
    }

    public function down()
    {
        $table = new Blueprint('will');
        $this->executeSQL($table->dropSQL());
    }
}
