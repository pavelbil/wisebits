<?php


namespace App\Repositories;


class EmailArrayBlackList implements WhiteListRepository
{

    const MAILERS = [
        'mail.ru' => true,
        'inbox.ru' => true
    ];

    public function isExist(string $value): bool
    {
        return !empty(self::MAILERS[$value]);
    }
}