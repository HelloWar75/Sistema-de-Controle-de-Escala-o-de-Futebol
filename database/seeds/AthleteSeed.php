<?php

use Illuminate\Database\Seeder;
use App\Athlete;

class AthleteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Athlete::create([
            'position_id' => 1,
            'team_id' => 1,
            'name' => 'Ronaldo',
            'shirt_number' => '1'
        ]);
        Athlete::create([
            'position_id' => 2,
            'team_id' => 1,
            'name' => 'Rafel',
            'shirt_number' => '2'
        ]);

        Athlete::create([
            'position_id' => 1,
            'team_id' => 2,
            'name' => 'Laerte',
            'shirt_number' => '1'
        ]);
        Athlete::create([
            'position_id' => 2,
            'team_id' => 2,
            'name' => 'Thiado',
            'shirt_number' => '2'
        ]);
    }
}
