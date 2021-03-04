<?php


namespace App\Repositories;

interface QueryRepository
{
    /**
     * @param array $criteria
     */
    public function findBy(array $criteria): array;
}