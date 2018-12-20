<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Restaurant;
use App\User;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurant = new Restaurant();
        $restaurant->name = 'Restaurant 1';
        $restaurant->address = 'Via principal del pueblo XX';
        $restaurant->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $restaurant->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $restaurant->save();

        $restaurant1 = new Restaurant();
        $restaurant1->name = 'Restaurant 2';
        $restaurant1->address = 'Ruta 14, cruce con el callejon 20';
        $restaurant1->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $restaurant1->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $restaurant1->save();

        $restaurant = new Restaurant();
        $restaurant->name = 'Restaurant 3';
        $restaurant->address = 'Troncal 9, sector valle nuevo';
        $restaurant->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $restaurant->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $restaurant->save();

        //Asign Role User
        //$user = User::find(2);
        //$user->restaurants()->attach($restaurant1);
    }
}
