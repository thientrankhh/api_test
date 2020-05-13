<?php

use Illuminate\Database\Seeder;

class OverTimesTableSeeder extends Seeder
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
                'creator_id' => '1',
                'member_id' => '[2,3,4]',
                'date' => '2020-05-13',
                'from' => '17:10:02',
                'to' => '18:10:02',
                'approval_id' => '1',
                'reason' => 'OT',
            ]
        ];
        DB::table('overtimes')->insert($data);
    }
}
