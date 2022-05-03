<?php


use Illuminate\Database\Seeder;
use App\Type;
use Faker\Generator as Faker;


class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = ['Italiano','Sushi','Giapponese',
                'Internazionale','Cinese','Americano','Poke',
                'FastFood','Smoothie','Gelato','Sandwitch','Hamburgher',
                'Vegan','Gluten free','Vegetariano','Pizza'];

        for($i = 0 ; $i <count($types) ; $i++){
            $newType = new Type();
            $newType->name = $types[$i];
            $newType->save();
    
        }
    }

}
