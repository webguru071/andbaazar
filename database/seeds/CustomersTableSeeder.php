<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
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
          'first_name'          => 'Sofiq',
          'last_name'           => 'Mia',
          'dob'                 => '2000-01-01',
          'gender'              => 'Male',
          'description'         => 'Student',
          'last_visited_at'     => '2000-01-02',
          'last_visited_from'   => '10.00am',
          'verification_token'  => '2',
          'remember_token'      => 'M2',
          'user_id'             => '2',
          'created_at'  => now(),
          'updated_at'  => now()
      ]
  ];

  DB::table('customers')->insert($data);
 }
}
