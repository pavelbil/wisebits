<?php


namespace App\Repositories;


class MemoryNameWhiteListInterface implements WhiteListRepositoryInterface
{

    const AVAILABLE_NAMES = [
        'pavel001' => true,
        'pavel002' => true,
        'pavel003' => true,
        'pavel004' => true,
        'pavel005' => true,
        'pavel006' => true,
    ];

    public function isExist(string $value): bool
    {
        return !empty(self::AVAILABLE_NAMES[$value]);
    }
}