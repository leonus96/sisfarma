<?php

use Illuminate\Database\Seeder;

class MedicamentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicament = [
            'descripcion' => 'Panadol',
            'unidad' => '1g',
        ];
        DB::table('medicaments')->insert($medicament);
    }
}
