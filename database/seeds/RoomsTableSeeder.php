<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'name' => '1~3の部屋',
        ]);

        DB::table('rooms')->insert([
            'name' => '3と4の部屋',
        ]);

    }
}
