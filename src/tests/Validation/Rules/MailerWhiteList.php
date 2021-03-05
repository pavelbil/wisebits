<?php

namespace Tests\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

/**
 * Class MailerWhiteList
 * @package Tests\Validation\Rules
 */
class MailerWhiteList extends AbstractRule
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