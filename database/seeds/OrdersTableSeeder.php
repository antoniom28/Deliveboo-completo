<?php

use Illuminate\Database\Seeder;
use App\Order;
use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $fakeTotal = [
            50,66,80,26,50
        ];

        for($i = 0 ; $i <5; $i++){
            $newOrder = new Order();
            $newOrder->name = $faker->firstName(20);
            $newOrder->surname = $faker->lastName(20);
            $newOrder->email = $faker->email();
            $newOrder->phone = $faker->e164PhoneNumber();
            $newOrder->address = $faker->address();
            $newOrder->total = $fakeTotal[$i];
            $newOrder->status = $faker->boolean();
            $newOrder->user_id = 1;
            $newOrder->save();
        }
    }
}
