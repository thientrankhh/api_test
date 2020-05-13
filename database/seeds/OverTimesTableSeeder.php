<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OverTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $from = Carbon::now('Asia/Ho_Chi_Minh');
        $to = Carbon::now('Asia/Ho_Chi_Minh')->addHours(2);

        $data = [
            [
                'creator_id' => '1',
                'member_id' => '[2,3,4]',
                'from' => $from,
                'to' => $to,
                'approval_id' => '1',
                'reason' => 'OT',
            ]
        ];
        DB::table('overtimes')->insert($data);
    }
}
