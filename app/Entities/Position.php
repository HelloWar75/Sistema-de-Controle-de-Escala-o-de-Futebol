<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Position.
 *
 * @package namespace App\Entities;
 */
class Position extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function transform()
    {
        // TODO: Implement transform() method
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

}
