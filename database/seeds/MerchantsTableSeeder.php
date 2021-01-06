<?php

use Illuminate\Database\Seeder;

class MerchantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'slug'                => 'rofiq',
                'dob'                 => '2000-01-03',
                'gender'              => 'Male',
                'description'         => 'Student',
                'last_visited_at'     => '2015-01-03',
                'last_visited_from'   => '10.00am',
                'user_id'             => '3',
                'created_at'          => now(),
                'updated_at'          => now()
            ],
            [
                'slug'                => 'oli',
                'dob'                 => '2000-01-03',
                'gender'              => 'Male',
                'description'         => 'Student',
                'last_visited_at'     => '2015-01-03',
                'last_visited_from'   => '10.00am',
                'user_id'             => '4',
                'created_at'          => now(),
                'updated_at'          => now()
            ],
        ];

        DB::table('merchant_profile')->insert($data);
       }
}
