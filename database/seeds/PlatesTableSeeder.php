<?php

use Illuminate\Database\Seeder;
use App\Plate;
use Faker\Generator as Faker;
class PlatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $name = [
            ['Classic BBQ','Tagliata di petto di pollo','Gran cotoletta di pollo','filetto'],
            ['Hot Maui','Mr. Avocado ','Pacifik','Volcano'],
            ['Big Bacon','Cheeseburger','Chicken royale','Chicken snackbox'],
            ['Biscotti artigianali','Gelato PeacePop','Biscotti AYO','B&J Crem Caramel chew chew 100 ml'],
            ['Sicily rolls - 6 pezzi','Hot salmon - 8 pezzi','Takaeshita street','Satrincha box'],
            ['Margherita','Diavola','Salsiccia','4 stagioni']
        ];

        $ingredient = [
            ['Costine di maiale affumicato, salsa BBQ'],
            ['Petto di pollo','rucola','pomodorini'],
            ['Petto di pollo intero con panatura a regola d arte'],
            ['100% italian beef','circa 220gr'],

            ['Pane tostato','crema di burrata','avocado','pomodorini','basilico'],
            ['Base a scelta', 'tofu fritto', 'crema di avocado', 'edamame', 'alga wakame', 'cetrioli', 'anacardi', 'ravanelli'],
            ['Base e proteina a scelta', 'salsa Pacifik dalle note agrumate', 'edamame', 'avocado', 'alga wakame', 'anacardi e topping di tobiko ed erba cipollina'],
            ['Base e proteina a scelta', 'salsa Volcano a base di “mayo” piccante', 'edamame', 'cetrioli', 'alga wakame', 'anacardi', 'ravanelli e topping di tobiko ed erba cipollina'],

            ['3 fette di carne','formaggio'],
            ['carne','formaggio'],
            ['Croccante leggerezza', 'Usiamo solo il nostro panino al sesamo extralungo', 'con tanto petto di pollo dorato'],
            ['6 nuggets', '4 wings'],

            ['vaniglia', 'pezzetti di copertura al cacao', 'due biscotti', 'pezzetti di cioccolato'],
            ['4 PeacePop a stecco a scelta.'],
            ['vaniglia', 'pezzetti di copertura al cacao', 'due biscotti', 'pezzetti di cioccolato'],
            ['Gelato al latte al caramello con un vortice di caramello (9%)', 'pezzetti di caramello ricoperti di cioccolato (9%)'],

            ['Gambero fritto in tempura', 'tartare di gamberi rossi'],
            ['uova di aringa affumicata', 'avocado' , 'foglie di shiso'],
            ['Oshi-Zushi pressato' , 'salmone teriyaki alla piastra', 'cipolla fritta'],
            ['2 california', '2 philadelphia', '2 spicy toro', '2 hot salmon', '2 Zushi roll', '2 rainbow'],

            ['Pomodoro', 'mozzarella'],
            ['Pomodoro', 'mozzarella', 'salamino piccante'],
            ['Pomodoro', 'mozzarella', 'salsiccia'],
            ['Pomodoro', 'mozzarella', 'prosciutto cotto', 'carciofi', 'funghi e olive'],
        ];

        $index = 0;
        for($j = 0 ; $j <6; $j++){
            for($i = 0 ; $i <4; $i++){
                $newPlate = new Plate();
                $newPlate->name = $name[$j][$i];
                $newPlate->ingredients = implode(",",$ingredient[$index]);
                if($j == 0)
                    $newPlate->price = 10 + 2*$i;
                else
                    $newPlate->price = $faker->randomFloat(2,0,25);
                //$newPlate->visible = $faker->boolean();
                $newPlate->visible = 1;
                $newPlate->img = NULL;
                $newPlate->user_id = $j+1;
                $newPlate->save();
                $index++;
            }
        }
        
    }
}
