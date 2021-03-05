<?php

namespace Tests\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

/**
 * Class NameBlackList
 * @package Tests\Validation\Rules
 */
class NameBlackList extends AbstractRule
{
    public function __construct()
    {
    }

    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input): bool
    {
        return true;
    }
}