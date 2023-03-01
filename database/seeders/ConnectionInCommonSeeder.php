<?php

namespace Database\Seeders;

use App\Models\Connection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConnectionInCommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Connection::create([
            'user_id'   => 1,
            'connection_id'   => 2,
        ]);

        Connection::create([
            'user_id'   => 1,
            'connection_id'   => 3,
        ]);

        Connection::create([
            'user_id'   => 2,
            'connection_id'   => 3,
        ]);

        Connection::create([
            'user_id'   => 4,
            'connection_id'   => 3,
        ]);

        Connection::create([
            'user_id'   => 5,
            'connection_id'   => 3,
        ]);
    }
}
