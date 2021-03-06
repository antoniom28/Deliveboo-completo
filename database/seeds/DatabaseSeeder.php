<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PlatesTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(TypesUsersTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrdersPlatesTableSeeder::class);
    }
}
