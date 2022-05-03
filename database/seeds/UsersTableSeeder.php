<?php

use App\User;
use Illuminate\Database\Seeder;
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
        $newUser = new User();
        $newUser->name = "Francesco Franchetti";
        $newUser->email = "lacantina92@gmail.com";
        $newUser->password = Hash::make('prova123');
        $newUser->activity = "La Cantina";
        $newUser->p_iva = "12345678912";
        $newUser->address = "Via nuova perla , 92";
        $newUser->save();
        
        $newUser = new User();
        $newUser->name = "Francesco Celso";
        $newUser->email = "tigellabella@gmail.com";
        $newUser->password = Hash::make('prova123');
        $newUser->activity = "Gella bella";
        $newUser->p_iva = "12345678934";
        $newUser->address = "Via nuova casa , 32";
        $newUser->save();


        $newUser = new User();
        $newUser->name = "Francesco Grassi";
        $newUser->email = "hamburger@gmail.com";
        $newUser->password = Hash::make('prova123');
        $newUser->activity = "Hamburger goloso";
        $newUser->p_iva = "12345678956";
        $newUser->address = "Via nuova casa , 32";
        $newUser->save();

        $newUser = new User();
        $newUser->name = "Francesco Franchetti";
        $newUser->email = "gelatoayo@gmail.com";
        $newUser->password = Hash::make('prova123');
        $newUser->activity = "Gelato ayo";
        $newUser->p_iva = "12345678912";
        $newUser->address = "Via nuova perla , 92";
        $newUser->save();


        $newUser = new User();
        $newUser->name = "mia jaki";
        $newUser->email = "sushiwow@gmail.com";
        $newUser->password = Hash::make('prova123');
        $newUser->activity = "SushiWow";
        $newUser->p_iva = "12345678934";
        $newUser->address = "Via nuova casa , 32";
        $newUser->save();

        $newUser = new User();
        $newUser->name = "Ciruzzu il Grande";
        $newUser->email = "ciropizza@gmail.com";
        $newUser->password = Hash::make('prova123');
        $newUser->activity = "ciruzzo pizza";
        $newUser->p_iva = "12345678956";
        $newUser->address = "Via nuova casa , 32";
        $newUser->save();
    }
}
