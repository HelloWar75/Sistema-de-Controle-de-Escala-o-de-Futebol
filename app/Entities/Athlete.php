<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Athlete.
 *
 * @package namespace App\Entities;
 */
class Athlete extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position_id',
        'team_id',
        'name',
        'shirt_number'
    ];

    public function team()
    {
        return $this->belongsTo('App\Entities\Team');
    }

    public function position()
    {
        return $this->belongsTo('App\Entities\Position');
    }

    public function transform()
    {
        // TODO: Implement transform() method.
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'shirt_number' => (int) $this->shirt_number,
            'position' => [
                'id' => $this->position->id,
                'name' => $this->position->name
            ],
            'team' => [
                'id' => $this->team->id,
                'name' => $this->team->name
            ]
        ];
    }
}
