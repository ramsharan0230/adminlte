<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Modules\Role\Entities\Role;
use Modules\Branch\Entities\Branch;
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

        $faker = Faker::create();
        $roles = Role::where('status', 1)->pluck('id')->all();
        $shuffled = shuffle($roles);

        $branches = Branch::where('status', 1)->pluck('id')->all();
        $shuffled = shuffle($branches);

        for($i=0; $i<4; $i++){
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'role_id' => $faker->numberBetween(min($roles), max($roles)),
                'branch_id' => $faker->numberBetween(min($branches), max($branches)),
                'current_status' => 'approved',
                'password' => Hash::make('admin@123')
            ]);
        }
        
    }
}
