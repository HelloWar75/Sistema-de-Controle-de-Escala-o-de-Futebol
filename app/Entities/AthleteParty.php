<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AthleteParty.
 *
 * @package namespace App\Entities;
 */
class AthleteParty extends Model implements Transformable
{

    protected $table = 'athletes_parties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'party_id',
        'athlete_id',
    ];

    public function athlete()
    {
        return $this->belongsTo('App\Entities\Athlete');
    }

    public function party()
    {
        return $this->belongsTo('App\Entities\Party');
    }

    public function transform()
    {
        // TODO: Implement transform() method.
        return [
            'party' => $this->party->transform(),
            'athlete' => $this->athlete->transform()
        ];
    }

}
