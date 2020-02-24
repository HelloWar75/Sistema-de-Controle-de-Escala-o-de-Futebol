<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Luis Justin',
            'email' => 'luisjustin72@gmail.com',
            'password' => bcrypt('123')
        ]);
    }
}
