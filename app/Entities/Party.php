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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'team_1_id',
        'team_2_id',
        'party_date'
    ];

    public function team_1()
    {
        return $this->belongsTo('App\Entities\Team');
    }

    public function team_2()
    {
        return $this->belongsTo('App\Entities\Team');
    }

    public function transform()
    {
        // TODO: Implement transform() method.
        $date = new \DateTime($this->party_date);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'team_1' => [
                'id' => $this->team_1->id,
                'name' => $this->team_1->name
            ],
            'team_2' => [
                'id' => $this->team_2->id,
                'name' => $this->team_2->name
            ],
            'date' => $date->format('Y-m-d')
        ];
    }

}
