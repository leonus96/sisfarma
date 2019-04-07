<?php

use Illuminate\Database\Seeder;

class PrincipleActiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $principle = [
            'nombre' => 'Paracetamol',
            'descripcion' => 'no se',
        ];
        DB::table('active_principles')->insert($principle);
    }
}
