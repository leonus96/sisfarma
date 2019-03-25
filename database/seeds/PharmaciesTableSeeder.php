<?php

use Illuminate\Database\Seeder;

class PharmaciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Los datos de esta farmacia deben ser modificados para producción
        $pharmacy = [
            'ruc' => '12345678910',
            'name' => 'Farmacia de Prueba',
        ];
        DB::table('pharmacies')->insert($pharmacy);

    }
}
