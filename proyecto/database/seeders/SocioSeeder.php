<?php

namespace Database\Seeders;

use App\Models\Socio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Elimina todos los registros antiguos de la tabla 'socios'
        // DB::table('socios')->truncate();

        Socio::factory()
            ->count(15) // Crea 15 registros de socios
            ->create();  // Guarda los registros en la base de datos
    }
}
