<?php

namespace Tests\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class UniqueValue extends AbstractRule
{
    public function __construct()
    {
    }

    public function validate($input): bool
    {
        return true;
    }
}