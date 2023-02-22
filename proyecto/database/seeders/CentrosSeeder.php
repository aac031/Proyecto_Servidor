<?php

namespace Database\Seeders;

use App\Models\Centro;
use Illuminate\Database\Seeder;

class CentrosSeeder extends Seeder
{
    public function run()
    {
        Centro::create([
            'nombre' => 'Peluqueria',
            'razon_social' => 'Peluqueria S.L.',
            'direccion' => 'Calle Uno, 1',
            'telefono' => '123-456-789',
            'email' => 'peluqueria@example.com',
            'nif' => '12345678A',
            'tipo' => 'peluqueria',
            'capacidad_maxima' => 50,
            'unisex' => true,
            'numero_salas' => null,
            'servicio_fisioterapia' => null,
        ]);

        Centro::create([
            'nombre' => 'Estetica',
            'razon_social' => 'Estetica S.L.',
            'direccion' => 'Calle Dos, 1',
            'telefono' => '123-456-789',
            'email' => 'estetica@example.com',
            'nif' => '12345678B',
            'tipo' => 'estetica',
            'capacidad_maxima' => null,
            'unisex' => null,
            'numero_salas' => 20,
            'servicio_fisioterapia' => true,
        ]);
    }
}
