<?php

use Illuminate\Database\Seeder;
use App\UserRoom;
class UserRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * 1~3がルーム1へ、3,4がルーム2へ
         */
        for ($ri=1; $ri < 3; $ri++) {
            if ($ri == 1) {
                for ($ui=1; $ui < 4; $ui++) { 
                    UserRoom::create([
                        'room_id' => $ri,
                        'user_id' => $ui
                    ]);
                }
            } else {
                for ($ui=3; $ui < 5 ; $ui++) { 
                    UserRoom::create([
                        'room_id' => $ri,
                        'user_id' => $ui
                    ]);
                }
            }

        }

    }
}
