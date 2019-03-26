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
                'admin_tera' => true,
                'pharmacy_id' => Pharmacy::ID,
            ],
            [
                'nombre' => 'Joseph León',
                'email' => 'leonues96@gmail.com',
                'password' => bcrypt('88888888'),
                'admin_tera' => true,
                'pharmacy_id' => Pharmacy::ID,
            ],
        ];
        DB::table('users')->insert($users);
    }
}
