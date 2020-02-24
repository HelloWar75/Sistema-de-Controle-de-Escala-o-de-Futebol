<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class AthleteValidator.
 *
 * @package namespace App\Validators;
 */
class AthleteValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        'position_id' => 'required',
        'team_id' => 'required',
        'name' => 'required',
        'shirt_number' => 'required'
    ];
}
