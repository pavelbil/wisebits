<?php


namespace App\Repositories;


class MemoryNameBlackList implements WhiteListRepositoryInterface
{

    const FORBIDDEN_NAMES = [
        'pavel001' => true,
        'pavel002' => true,
        'pavel003' => true,
        'pavel004' => true,
        'pavel005' => true,
        'pavel006' => true,
    ];

    public function isExist(string $value): bool
    {
        return !empty(self::FORBIDDEN_NAMES[$value]);
    }
}