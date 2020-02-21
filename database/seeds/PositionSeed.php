<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $positions = [
            "Goleiro",
            "Lateral direito",
            "Lateral Esquerdo",
            "Zagueiro",
            "Meia",
            "Volante",
            "Meia Atacante",
            "Armador",
            "Ataque",
            "Atacante",
            "Ponta",
            "Juiz",
            "Artilheiro",
            "Titular",
            "Reserva",
            "Técnico"
        ];

        foreach($positions as $v)
        {
            Position::create([
                'name' => $v
            ]);
        }

    }
}
