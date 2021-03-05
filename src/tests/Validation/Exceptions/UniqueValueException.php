<?php

namespace Tests\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class UniqueValueException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Value must be unique.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Value must be unique.',
        ],
    ];
}