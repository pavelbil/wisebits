<?php


namespace App\Repositories;

interface QueryRepositoryInterface
{
    /**
     * @param array $criteria
     */
    public function findBy(array $criteria): array;
}