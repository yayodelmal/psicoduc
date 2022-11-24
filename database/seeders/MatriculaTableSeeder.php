<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matricular;

class MatriculaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matricular = new Matricular();
        $matricular->nombre = 'Mauricio';
        $matricular->apellidos = 'Gutiérrez';
        $matricular->email = 'eduardogutierrezm@icloud.com';
        $matricular->nombre_usuario = 'mauriciogm';
        $matricular->contrasenia = 'prueba123';
        $matricular->unidad = 'Cirugía adulto';
        $matricular->curso_id = '1';
        $matricular->nombre_corto_curso = 'IN1';
        $matricular->nombre_largo_curso = 'Intervención nº1';
        $matricular->cantidad_dias_ingreso = 0;
        $matricular->registrado = 1;
        $matricular->save();
    }
}
