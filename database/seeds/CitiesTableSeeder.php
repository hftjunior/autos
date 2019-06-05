<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'state_id'  => '13',
            'name'      => 'Belo Horizonte',
            'initial'   => 'BHZ'
        ]);
        City::create([
            'state_id'  => '13',
            'name'      => 'Curvelo',
            'initial'   => 'CVO'
        ]);
        City::create([
            'state_id'  => '13',
            'name'      => 'Timóteo',
            'initial'   => 'TMO'
        ]);
    }
}
