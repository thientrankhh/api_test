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
                'scopes' => json_encode(['create','approve','view-all'])
            ],
            [
                'name' => 'approval',
                'scopes' => json_encode(['create','approve'])
            ],
            [
                'name' => 'user',
                'scopes' => 'create'
            ]
        ];

        DB::table('roles')->insert($data);
    }
}
