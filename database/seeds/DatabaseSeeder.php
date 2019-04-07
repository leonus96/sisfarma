<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PharmaciesTableSeeder::class,
            UsersTableSeeder::class,
            LaboratoryTableSeeder::class,
            PrincipleActiveTableSeeder::class,
            MedicamentTableSeeder::class,
        ]);
    }
}
