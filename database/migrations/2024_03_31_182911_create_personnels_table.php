<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('nom',50)->nullable();
            $table->string('prenom',255)->nullable();
            $table->string('email',255)->nullable();
           
            $table->string('password',255)->nullable();
            $table->string('departement',255)->nullable();
            $table->string('poste_occupe',255)->nullable();
            $table->date('date_embauche')->nullable();
            $table->string('sexe',25)->nullable();
            $table->string('token')->nullable();
            $table->timestamp('heurearrive')->nullable();
            $table->timestamp('heuredepart')->nullable();
            $table->string('status',255)->default('personnel');
            $table->string('status_presence',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnels');
    }
};
