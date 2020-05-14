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
                'creator_id' => 'ffb4bc90-959b-11ea-8bf4-af7bd9a4141e',
                'member_ids' => json_encode([
                    'ffb4df00-959b-11ea-b3c0-1d3e15540186',
                    'ffb4dfc0-959b-11ea-873f-17410ec2c621',
                    'ffb4e010-959b-11ea-9d7a-5f18ea966b45'
                ]),
                'from' => $from,
                'to' => $to,
                'approval_id' => 'ffb4df00-959b-11ea-b3c0-1d3e15540186',
                'reason' => 'Because we all like Nghia.'
            ]
        ];
        DB::table('overtimes')->insert($data);
    }
}
