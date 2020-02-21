<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $teams = [
          'Grêmio',
          'Internacional'
        ];

        foreach ($teams as $v) {
          Team::create([
            'name' => $v
          ]);
        }
    }
}
