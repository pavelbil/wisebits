<?php

namespace App\Validation\Rules;

/**
 * Class MailerWhiteList
 * @package App\Validation\Rules
 */
class MailerWhiteList extends ExistsValue
{

    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input): bool
    {
        $mailer = $this->getMailerByEmail($input);
        return parent::validate($mailer);
    }

    /**
     * @param $email
     * @return string
     */
    public function getMailerByEmail($email): string
    {
        $emailArray = explode('@', $email);
        if (count($emailArray) !== 2) {
            return '';
        }
        return end($emailArray);
    }
}