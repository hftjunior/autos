<?php

use App\Models\State;
use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
            'name'      => 'Acre',
            'initial'   => 'AC',
        ]);
        State::create([
            'name'      => 'Alagoas',
            'initial'   => 'AL',
        ]);
        State::create([
            'name'      => 'Amapá',
            'initial'   => 'AP',
        ]);
        State::create([
            'name'      => 'Amazonas',
            'initial'   => 'AM',
        ]);
        State::create([
            'name'      => 'Bahia',
            'initial'   => 'BA',
        ]);
        State::create([
            'name'      => 'Ceará',
            'initial'   => 'CE',
        ]);
        State::create([
            'name'      => 'Distrito Federaç',
            'initial'   => 'DF',
        ]);
        State::create([
            'name'      => 'Espírito Santos',
            'initial'   => 'ES',
        ]);
        State::create([
            'name'      => 'Goiás',
            'initial'   => 'GO',
        ]);
        State::create([
            'name'      => 'Maranhão',
            'initial'   => 'MA',
        ]);
        State::create([
            'name'      => 'Mato Grosso',
            'initial'   => 'MT',
        ]);
        State::create([
            'name'      => 'Mato Grosso do Sul',
            'initial'   => 'MS',
        ]);
        State::create([
            'name'      => 'Minas Gerais',
            'initial'   => 'MG',
        ]);
        State::create([
            'name'      => 'Pará',
            'initial'   => 'PA',
        ]);
        State::create([
            'name'      => 'Paraíba',
            'initial'   => 'PB',
        ]);
        State::create([
            'name'      => 'Paraná',
            'initial'   => 'PR',
        ]);
        State::create([
            'name'      => 'Pernambuco',
            'initial'   => 'PE',
        ]);
        State::create([
            'name'      => 'Piauí',
            'initial'   => 'PI',
        ]);
        State::create([
            'name'      => 'Rio de Janeiro',
            'initial'   => 'RJ',
        ]);
        State::create([
            'name'      => 'Rio Grande do Norte',
            'initial'   => 'RN',
        ]);
        State::create([
            'name'      => 'Rio Grande do Sul',
            'initial'   => 'RS',
        ]);
        State::create([
            'name'      => 'Rondônia',
            'initial'   => 'RO',
        ]);
        State::create([
            'name'      => 'Roraima',
            'initial'   => 'RR',
        ]);
        State::create([
            'name'      => 'Santa Catarina',
            'initial'   => 'SC',
        ]);
        State::create([
            'name'      => 'São Paulo',
            'initial'   => 'SP',
        ]);
        State::create([
            'name'      => 'Sergipe',
            'initial'   => 'SE',
        ]);
        State::create([
            'name'      => 'Tocantins',
            'initial'   => 'TO',
        ]);
    }
}
