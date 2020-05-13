<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
                'name' => 'admin'
            ],
            [
                'name' => 'approval'
            ],
            [
                'name' => 'user'
            ]
        ];

        DB::table('roles')->insert($data);
    }
}
