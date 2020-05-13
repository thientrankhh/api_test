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
                'name' => 'admin1',
                'email' => 'admin@gmail.com',
                'role_id' => 1
            ],
            [
                'name' => 'thien',
                'email' => 'thien@gmail.com',
                'role_id' => 2
            ],
            [
                'name' => 'Akos',
                'email' => 'akos@gmail.com',
                'role_id' => 3
            ],
            [
                'name' => 'Aoi',
                'email' => 'aoi@gmail.com',
                'role_id' => 3
            ],
            [
                'name' => 'May',
                'email' => 'may@gmail.com',
                'role_id' => 3
            ]
        ];

        DB::table('users')->insert($data);
    }
}
