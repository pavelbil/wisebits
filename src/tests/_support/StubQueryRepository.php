<?php


namespace Tests;


use App\Repositories\QueryRepository;

class StubQueryRepository implements QueryRepository
{

    public function findBy(array $criteria): array
    {
        return [];
    }
}