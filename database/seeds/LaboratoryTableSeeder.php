<?php

use Illuminate\Database\Seeder;

class LaboratoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $laboratory = [
            'nombre' => 'Bayern',
        ];
        DB::table('laboratories')->insert($laboratory);
    }
}
