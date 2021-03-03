<?php


namespace App\Validators;


class EmailValidator extends Validator
{
    public string $pattern = '/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/';

    protected function validateValue($value): bool
    {
        if (!is_string($value)) {
            $valid = false;
        } else {
            $valid = preg_match($this->pattern, $value);
        }
        return $valid;
    }

    protected function getErrorMessage(): string
    {
        return 'Email is invalid';
    }

}