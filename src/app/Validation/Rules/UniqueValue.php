<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

final class UniqueValue extends AbstractRule
{

    public $repository;
    public string $repositoryMethod = 'findBy';

    public function validate($input): bool
    {
        return true;
    }
}