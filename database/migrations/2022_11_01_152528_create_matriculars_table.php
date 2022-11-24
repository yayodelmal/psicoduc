<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatricularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculars', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60);
            $table->string('apellidos', 60);
            $table->string('email', 60);
            $table->string('nombre_usuario');
            $table->string('contrasenia', 60)->nullable();
            $table->string('categoria', 220)->nullable();
            $table->integer('curso_id')->nullable()->default(-1);
            $table->string('nombre_corto_curso', 120)->nullable();
            $table->string('nombre_largo_curso', 220)->nullable();
            $table->integer('cantidad_dias_ingreso')->nullable()->default(0);
            $table->boolean('registrado')->nullable()->default(0);
            $table->boolean('matricula')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculars');
    }
}
