<?php


namespace Tests\Repository;


use App\Repositories\WhiteListRepository;

class MemoryWhiteListRepository implements WhiteListRepository
{

    public function isExist(string $value): bool
    {
        return true;
    }
}