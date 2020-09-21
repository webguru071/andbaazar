<?php

use Illuminate\Database\Seeder;

class RejectTableSeeder extends Seeder
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
                'rej_name'   => 'Your profile image is obscure.',
                'type'       => 'profile',
                'user_id'    => 1, 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'your nid image is obscure.',
                'type'       => 'profile',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'Add Your full address.',
                'type'       => 'profile',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'You not upload your trade licence.',
                'type'       => 'profile',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'You product image is obscure.',
                'type'       => 'product',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'You product image not mathch with product.',
                'type'       => 'product',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'add product details.',
                'type'       => 'product',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'product condition is not good.',
                'type'       => 'product',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'please upload news feed image.',
                'type'       => 'feed',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'Description of news is harmfull for our community.',
                'type'       => 'feed',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'News feed title too short.',
                'type'       => 'feed',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'You auction product image is obscure.',
                'type'       => 'auction',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'rej_name'   => 'product condition is not good.',
                'type'       => 'auction',
                'user_id'    => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
           
        ];
        DB::table('rejects')->insert($data);
    }
}
