<?php

namespace Database\Seeders;

use App\Models\Centro;
use App\Models\Treatment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CentroTreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centros = Centro::all();

        foreach ($centros as $centro) {
            if ($centro->tipo === 'peluqueria') {
                $treatments = Treatment::where('type', 'peluqueria')
                    ->whereIn('name', ['micropigmentación', 'cuidado cabello'])
                    ->get();
            } else {
                $treatments = Treatment::where('type', 'estetica')
                    ->whereNotIn('name', ['micropigmentación', 'cuidado cabello'])
                    ->get();
            }

            $centro->treatments()->attach($treatments);
        }
    }
}
