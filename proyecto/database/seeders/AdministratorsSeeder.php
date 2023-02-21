<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdministratorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        // Elimina todos los registros antiguos de la tabla 'administrators'
        // DB::table('administrators')->truncate();

        // Genero todos los datos aleatorios para introducirlos en la tabla 'administrators'
        for ($i = 1; $i <= 10; $i++) {
            $rol = $i <= 2 ? 'gerente' : 'recepcionista';

            $email = $faker->unique()->safeEmail;

            User::create([
                'name' => $faker->name,
                'email' => $email,
                'password' => Hash::make($email),
                'rol' => $rol
            ]);
        }
    }
}
