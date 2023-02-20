<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('treatments')->truncate();

        $faker = Factory::create();

        $names = ['micropigmentación', 'cuidado cabello', 'mesoterapia', 'masajes', 'fotodepilación'];

        foreach ($names as $name) {
            $uniqueName = $this->generateUniqueName($name);
            $price = $faker->randomFloat(2, 30, 120);
            $type = $faker->randomElement(['estetica', 'peluqueria']);

            DB::table('treatments')->insert([
                'name' => $uniqueName,
                'price' => $price,
                'type' => $type,
            ]);
        }
    }

    private function generateUniqueName($name)
    {
        $uniqueName = $name;
        $index = 1;

        while (DB::table('treatments')->where('name', $uniqueName)->exists()) {
            $uniqueName = $name . ++$index;
        }

        return $uniqueName;
    }
}
