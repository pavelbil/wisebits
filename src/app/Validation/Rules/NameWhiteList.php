<?php

namespace App\Validation\Rules;

/**
 * Class NameWhiteList
 * @package App\Validation\Rules
 */
class NameWhiteList extends ExistsValue
{

    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input): bool
    {
        return !parent::validate($input);
    }
}