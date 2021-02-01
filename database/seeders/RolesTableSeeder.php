<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Hygiene'
        ]);
        Role::create([
            'name' => 'Site Manager'
        ]);
        Role::create([
            'name' => 'Operation Manager'
        ]);
        Role::create([
            'name' => 'Senior Operation Manager'
        ]);
    }
}
