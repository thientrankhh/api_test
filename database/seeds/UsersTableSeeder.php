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
                'id' => 'ffb4bc90-959b-11ea-8bf4-af7bd9a4141e',
                'name' => 'Hoang',
                'email' => 'intern@dienhoa1080.com',
                'role_id' => 1
            ],
            [
                'id' => 'ffb4df00-959b-11ea-b3c0-1d3e15540186',
                'name' => 'Thien',
                'email' => 'thien@gmail.com',
                'role_id' => 2
            ],
            [
                'id' => 'ffb4dfc0-959b-11ea-873f-17410ec2c621',
                'name' => 'Akos',
                'email' => 'szabogaliakos@gmail.com',
                'role_id' => 2
            ],
            [
                'id' => 'ffb4e010-959b-11ea-9d7a-5f18ea966b45',
                'name' => 'Aoi',
                'email' => 'aoi@gmail.com',
                'role_id' => 3
            ],
            [
                'id' => 'ffb4e060-959b-11ea-988e-794550fbf121',
                'name' => 'May',
                'email' => 'may@gmail.com',
                'role_id' => 3
            ]
        ];

        DB::table('users')->insert($data);
    }
}
