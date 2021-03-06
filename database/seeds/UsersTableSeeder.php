<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=4; $i++) {
            DB::table('users')->insert([
                'name' => 'test' . $i . 'さん',
                'email' => $i.'@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }

    }
}
