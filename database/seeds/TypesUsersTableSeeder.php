<?php

use App\User;
use Illuminate\Database\Seeder;

class TypesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){     
        $type = [
            [null],
            [11,12,6],
            [7,13,15,4],
            [12,8,6],
            [10,9],
            [2,3,5],
            [16,1,14],
        ];

        for($j = 1; $j < 7 ; $j++){
            $user = User::all()->where('id',$j)->first();
            $user->types()->sync($type[$j]);
        }
    }
}
