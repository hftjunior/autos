<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'Administrador', 
            'slug' => 'admin',
            'permissions' => [
                'create-user'   => true,
                'edit-user'     => true,
                'delete-user'   => true,
                'view-user'     => true,
            ]
        ]);
        $view = Role::create([
            'name' => 'Visualizador', 
            'slug' => 'view',
            'permissions' => [
                'view-user' => true,
            ]
        ]);
    }
}
