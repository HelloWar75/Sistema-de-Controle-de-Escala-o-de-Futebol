<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Party.
 *
 * @package namespace App\Entities;
 */
class Party extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'team_1_id',
        'team_2_id',
        'date'
    ];

    public function team_1()
    {
        return $this->hasOne('App\Entities\Team', 'teams.id', 'team_1_id');
    }

    public function team_2()
    {
        return $this->hasOne('App\Entities\Team', 'teams.id', 'team_2_id');
    }

    public function transform()
    {
        // TODO: Implement transform() method.
        return [
            'name' => $this->name,
            'team_1' => [
                'id' => $this->team_1->id,
                'name' => $this->team_1->name
            ],
            'team_2' => [
                'id' => $this->team_2->id,
                'name' => $this->team_2->name
            ],
            'date' => $this->party_date
        ];
    }

}
