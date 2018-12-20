<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Erain Moya';
        $user->login = 'admin';
        $user->password = bcrypt('qwerty123');
        $user->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->save();

        $user = new User();
        $user->restaurant_id = 2;
        $user->name = 'Pedro Perez';
        $user->login = 'pedro';
        $user->password = bcrypt('123');
        $user->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->save();

        $user = new User();
        $user->name = 'App Api';
        $user->login = 'prueba';
        $user->password = bcrypt('tonyromas2018');
        $user->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->save();

        
    }
}
