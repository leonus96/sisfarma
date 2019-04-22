<?php

use Illuminate\Database\Seeder;
use App\Pharmacy;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nombre' => 'Carlos Córdova',
                'email' => 'carlosab1802@gmail.com',
                'password' => bcrypt('88888888'),
                'rol' => 'tera',
                'pharmacy_id' => Pharmacy::ID,
            ],
            [
                'nombre' => 'Joseph León',
                'email' => 'leonus96@gmail.com',
                'password' => bcrypt('88888888'),
                'rol' => 'tera',
                'pharmacy_id' => Pharmacy::ID,
            ],
            [
                'nombre' => 'Leticia Castillo',
                'email' => 'leticia@gmail.com',
                'password' => bcrypt('12345678'),
                'rol' => 'admin',
                'pharmacy_id' => Pharmacy::ID,
            ],
            [
                'nombre' => 'Vendedora',
                'email' => 'vendedora@gmail.com',
                'password' => bcrypt('12345678'),
                'rol' => 'vendedor',
                'pharmacy_id' => Pharmacy::ID,
            ],
        ];
        DB::table('users')->insert($users);
    }
}
