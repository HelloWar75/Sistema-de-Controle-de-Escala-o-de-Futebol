<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class TeamValidator.
 *
 * @package namespace App\Validators;
 */
class TeamValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        'name' => 'required|min:3|unique:teams'
    ];
}
