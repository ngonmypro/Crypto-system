<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class CreateStatus extends Seeder
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
                'name'  => 'OPEN',
            ],
            [
                'name'  => 'PENDING',
            ],
            [
                'name'  => 'COMPLETE',
            ],
            [
                'name'  => 'CLOSE',
            ],
            [
                'name'  => 'CANCEL',
            ],
        ];

        foreach ($data as $value) {
            Status::create([
                'name'  => $value['name'],
            ]);
        }
    }
}
