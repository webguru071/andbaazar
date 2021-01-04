<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name'    => 'Admin',
                'last_name'     => 'AndIt',
                'type'          => 'admin',
                'email'         => 'admin@andit.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Sofiq',
                'last_name'     => 'Mia',
                'email'         => 'buyer@andit.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'customers',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Rofiq',
                'last_name'     => 'Mia',
                'email'         => 'seller@andit.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'merchant',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Oli',
                'last_name'     => 'Mia',
                'email'         => 'and.baazar@yahoo.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'merchant',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Division',
                'last_name'     => 'Khulna',
                'email'         => 'agent1@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'District',
                'last_name'     => 'Khulna',
                'email'         => 'agent2@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'KCC',
                'last_name'     => 'Khulna',
                'email'         => 'agent3@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'KCC Ward 24',
                'last_name'     => 'Khulna',
                'email'         => 'agent4@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Dumuria',
                'last_name'     => 'Khulna',
                'email'         => 'agent5@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Kharnia',
                'last_name'     => 'Khulna',
                'email'         => 'agent6@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Tipna',
                'last_name'     => 'Khulna',
                'email'         => 'agent7@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Division',
                'last_name'     => 'Chattagram',
                'email'         => 'agent8@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Division',
                'last_name'     => 'Rajshahi',
                'email'         => 'agent9@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Division',
                'last_name'     => 'Barisal',
                'email'         => 'agent10@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Division',
                'last_name'     => 'Sylhet',
                'email'         => 'agent11@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Division',
                'last_name'     => 'Dhaka',
                'email'         => 'agent12@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Division',
                'last_name'     => 'Rangpur',
                'email'         => 'agent13@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Division',
                'last_name'     => 'Mymensingh',
                'email'         => 'agent14@gmail.com',
                'password'      => '$2y$10$LKt3BhpsEfO8O0fKEAOo..EekIBayyZunJpRTh8lv5mdLtdtMa0PO', //12345678
                'type'          => 'agent',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ];
        User::insert($users);
    }
}
