<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OvertimesTableSeeder extends Seeder
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
        $users = DB::table('users')->get();

        $data = [
            [
                'id' => Uuid::generate()->string,
                'creator_id' => $users[0]->id,
                'member_ids' => json_encode([$users[2]->id,$users[3]->id,$users[4]->id]),
                'from' => $from,
                'to' => $to,
                'approval_id' => $users[1]->id,
                'reason' => 'OT',
                'status' => 0
            ]
        ];
        DB::table('overtimes')->insert($data);
    }
}
