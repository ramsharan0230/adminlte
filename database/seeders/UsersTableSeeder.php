<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Hygiene',
            'email' => 'hygiene@email.com',
            'role_id' => 1,
            'password' => Hash::make('admin@123')
        ]);
    }
}
