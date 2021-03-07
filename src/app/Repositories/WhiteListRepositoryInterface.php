<?php


namespace App\Repositories;


interface WhiteListRepositoryInterface
{
    public function isExist(string $value): bool;
}