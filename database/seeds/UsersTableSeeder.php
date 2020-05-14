<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'id' => Uuid::generate()->string,
                'name' => 'Hoang',
                'email' => 'intern@dienhoa1080.com',
                'role_id' => 1
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Thien',
                'email' => 'thien@gmail.com',
                'role_id' => 2
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Akos',
                'email' => 'szabogaliakos@gmail.com',
                'role_id' => 2
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Aoi',
                'email' => 'aoi@gmail.com',
                'role_id' => 3
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'May',
                'email' => 'may@gmail.com',
                'role_id' => 3
            ]
        ];

        DB::table('users')->insert($data);
    }
}
