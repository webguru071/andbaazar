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
                'password'      => '$2y$10$Q988c.2aEMx7PC4ocmDTNOEVOsp5i9kRWgDsyQNcsS60BDtkBFN6q', //12345678
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Sofiq',
                'last_name'     => 'Mia',
                'email'         => 'buyer@andit.com',
                'password'      => '$2y$10$Q988c.2aEMx7PC4ocmDTNOEVOsp5i9kRWgDsyQNcsS60BDtkBFN6q', //12345678
                'type'          => 'customers',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Rofiq',
                'last_name'     => 'Mia',
                'email'         => 'seller@andit.com',
                // 'email'         => 'and.baazar@yahoo.com',
                'password'      => '$2y$10$Q988c.2aEMx7PC4ocmDTNOEVOsp5i9kRWgDsyQNcsS60BDtkBFN6q', //12345678
                'type'          => 'merchant',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'first_name'    => 'Oli',
                'last_name'     => 'Mia',
                'email'         => 'and.baazar@yahoo.com',
                'password'      => '$2y$10$Q988c.2aEMx7PC4ocmDTNOEVOsp5i9kRWgDsyQNcsS60BDtkBFN6q', //12345678
                'type'          => 'merchant',
                'created_at'    => now(),
                'updated_at'    => now()
            ]
        ];
        User::insert($users);
    }
}
