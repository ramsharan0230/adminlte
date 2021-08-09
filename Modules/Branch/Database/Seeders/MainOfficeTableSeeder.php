<?php

namespace Modules\Branch\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Branch\Entities\MainOffice;
use Faker\Factory as Faker;


class MainOfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<10; $i++){
            MainOffice::create([
                'name'=>$faker->name,
                'phone'=>$faker->phoneNumber,
                'address'=>$faker->address,
                'email'=>$faker->freeEmail,
                'fax' =>$faker->numerify
            ]);
        }
    }
}
