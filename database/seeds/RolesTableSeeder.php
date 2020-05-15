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
                'name' => 'admin',
                'scopes' => '["create","approve","admin"]'
            ],
            [
                'name' => 'approver',
                'scopes' => '["create","approve"]'
            ],
            [
                'name' => 'user',
                'scopes' => '["create"]'
            ]
        ];

        DB::table('roles')->insert($data);
    }
}
