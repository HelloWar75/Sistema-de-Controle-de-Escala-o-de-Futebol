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
            'email' => 'luisjustin@2labs.com.br',
            'password' => bcrypt('123')
        ]);
    }
}
