<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;

class Athlete extends Model implements Transformable
{
    //

    public function team()
    {
        $this->hasOne(Team);
    }

    public function position()
    {
        $this->hasOne(Position);
    }

    public function transform()
    {
        // TODO: Implement transform() method.
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'shirt_number' => (int) $this->shirt_number,
            'team_id' => $this->team()->id,
            'team_name' => $this->team()->name,
            'position_id' => $this->position()->id,
            'position_name' => $this->position()->name
        ];
    }
}
