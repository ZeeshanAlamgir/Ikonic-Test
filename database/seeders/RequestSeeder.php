<?php

namespace Database\Seeders;

use App\Models\UserRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRequest::create([
            'sender_id' => 1,
            'receiver_id' => 2,
        ]);

        UserRequest::create([
            'sender_id' => 3,
            'receiver_id' => 1,
        ]);

        UserRequest::create([
            'sender_id' => 4,
            'receiver_id' => 3,
        ]);

        UserRequest::create([
            'sender_id' => 6,
            'receiver_id' => 5,
        ]);

        UserRequest::create([
            'sender_id' => 6,
            'receiver_id' => 7,
        ]);
    }
}
