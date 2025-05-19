<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LimpiarDatosSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Primero eliminar las tablas hijas
        DB::table('reloj_control')->truncate();
        // Luego eliminar la tabla padre
        DB::table('funcionarios')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

