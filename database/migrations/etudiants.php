<?php

namespace Database\Migrations;

use App\Schema\Blueprint;
use App\Database\Migration;

class Etudiants extends Migration
{
    public function up()
    {
        $table = new Blueprint('etudiants');
        $table->id();
        $table->string('name');
        $table->string('prenoms');
        $table->string('email');
        $table->string('password');
        $table->string('telephone');
        $table->string('adresse');
        $table->string('ville');
        $table->string('pays');
        $table->string('code_postal');
        $table->string('sexe');
        $table->date('date_naissance');
        $table->timestamps();
        $this->executeSQL($table->getSQL());
    }

    public function down()
    {
        $table = new Blueprint('table_name');
        $this->executeSQL($table->dropSQL());
    }
}
