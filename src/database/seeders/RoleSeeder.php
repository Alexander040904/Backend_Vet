<?php

namespace Database\Seeders;
use App\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Crear dos registro de Roles
        $role = new Role();
        $role->role = 'Doctor';
        $role->save();

        $role = new Role();
        $role->role = 'Patient';
        $role->save();
        //
    }
}
