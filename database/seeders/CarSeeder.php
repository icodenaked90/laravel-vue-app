<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carMakes = ['Toyota', 'Honda', 'Ford', 'Chevrolet', 'Nissan', 'BMW', 'Mercedes', 'Audi', 'Tesla', 'Volkswagen'];

        for ($i = 1; $i <= 10; $i++) {
            $car = new Vehicle([
                'vehname' => $carMakes[array_rand($carMakes)],
                'vehiclecost' => rand(10000, 50000),
            ]);

            $car->save();
        }
    }
}
