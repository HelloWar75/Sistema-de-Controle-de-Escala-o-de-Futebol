<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;

class Team extends Model implements Transformable
{
    //

    public function transform()
    {
        // TODO: Implement transform() method.
        return [
            'id' => (int) $this->id,
            'name' => $this->name
        ];
    }
}
