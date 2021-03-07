<?php


namespace Tests\Repository;


use App\Repositories\WhiteListRepositoryInterface;

class MemoryWhiteListRepositoryInterface implements WhiteListRepositoryInterface
{

    public function isExist(string $value): bool
    {
        return true;
    }
}