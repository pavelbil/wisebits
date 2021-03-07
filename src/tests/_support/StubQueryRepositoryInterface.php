<?php


namespace Tests;


use App\Repositories\QueryRepositoryInterface;

class StubQueryRepositoryInterface implements QueryRepositoryInterface
{

    public function findBy(array $criteria): array
    {
        return [];
    }
}