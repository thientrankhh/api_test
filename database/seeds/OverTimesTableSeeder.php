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

        $data = [
            [
                'id' => 'f29b3390-959d-11ea-82d2-95a6c5fa4d4a',
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
