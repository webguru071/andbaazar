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
                'first_name'          => 'Rofiq',
                'last_name'           => 'Mia',
                'slug'                => 'rofiq',
                'email'               => 'seller@andit.com',
                'dob'                 => '2000-01-03',
                'gender'              => 'Male',
                'description'         => 'Student',
                'last_visited_at'     => '2015-01-03',
                'last_visited_from'   => '10.00am',
                'verification_token'  => '2',
                'remember_token'      => 'M2',
                'user_id'             => '3',
                'created_at'          => now(),
                'updated_at'          => now()
            ],
            [
                'first_name'          => 'Oli',
                'last_name'           => 'Mia',
                'slug'                => 'oli',
                'email'               => 'and.baazar@yahoo.com',
                'dob'                 => '2000-01-03',
                'gender'              => 'Male',
                'description'         => 'Student',
                'last_visited_at'     => '2015-01-03',
                'last_visited_from'   => '10.00am',
                'verification_token'  => '2',
                'remember_token'      => 'M2',
                'user_id'             => '4',
                'created_at'          => now(),
                'updated_at'          => now()
            ],
        ];

        DB::table('merchants')->insert($data);
       }
}
