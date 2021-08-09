<?php

namespace Modules\Branch\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Branch\Entities\MainOffice;
use Modules\Branch\Entities\Branch;
use Faker\Factory as Faker;

class BranchDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $faker = Faker::create();
        $seeder = new \Modules\Branch\Database\Seeders\MainOfficeTableSeeder();
        $seeder->run();

        $mainOffices = MainOffice::where('status', 1)->pluck('id')->all();
        
        $shuffled = shuffle($mainOffices);

        for($i=0; $i<10; $i++){
            Branch::create([
                'name'=>$faker->name,
                'main_office_id'=>$mainOffices[$i],
                'phone'=>$faker->phoneNumber,
                'address'=>$faker->address,
                'email'=>$faker->freeEmail,
                'fax' =>$faker->numerify
            ]);
        }
    }
}
