<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'id' => 'ffb4df00-959b-11ea-b3c0-1d3e15540186',
                'name' => 'Tran Nhat Thien',
                'email' => 'thien@gmail.com',
                'role_id' => 2
            ],
            [
                'id' => 'ffb4dfc0-959b-11ea-873f-17410ec2c621',
                'name' => 'Ákos Szabó-Gali',
                'email' => 'szabogaliakos@gmail.com',
                'role_id' => 2
            ],
            [
                'id' => 'ffb4e010-959b-11ea-9d7a-5f18ea966b45',
                'name' => 'Aoi Kurokawa',
                'email' => 'aoi@gmail.com',
                'role_id' => 3
            ],
            [
                'id' => 'ffb4e060-959b-11ea-988e-794550fbf121',
                'name' => 'Nguyen Thi May',
                'email' => 'may@gmail.com',
                'role_id' => 3
            ]
        ];

        $admin =  [
            'id' => 'ffb4bc90-959b-11ea-8bf4-af7bd9a4141e',
            'name' => 'Hoang Pham',
            'email' => 'intern@dienhoa1080.com',
            'password' => Hash::make('abc123!@#'),
            'role_id' => 1
        ];

        DB::table('users')->insert($data);
        DB::table('users')->insert($admin);
    }
}
