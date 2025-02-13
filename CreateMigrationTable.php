<?php

namespace Database\Migrations;

use App\Schema\Blueprint;
use App\Database\Migration;

class CreateMigrationTable extends Migration
{
    public function up()
    {
        $table = new Blueprint('migrations');
        $table->id();
        $table->string('migration'); // Nom de la migration
        $table->timestamps();
        $this->executeSQL($table->getSQL());
    }

    public function down()
    {
        $table = new Blueprint('migrations');
        $this->executeSQL($table->dropSQL());
    }
}
