<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\customer;

class customerseeder extends Seeder
{
    public function run(): void
    {
        // 1 record manual
        DB::table('customers')->insert([
            [
                'name' => 'Shruti',
                'email' => 'shruti@gmail.com',
                'password' => bcrypt('123456'),
                'phone' => '9876543211',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Faker records
        $faker = Faker::create();

        for($i = 1; $i <= 40; $i++)
        {
            $data = new customer();
            $data->name = $faker->name;
            $data->email = $faker->unique()->safeEmail;
            $data->password = bcrypt('123456');
            $data->phone = $faker->phoneNumber;
            $data->save();
        }
    }
}