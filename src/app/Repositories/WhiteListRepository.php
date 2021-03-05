<?php


namespace App\Repositories;


interface WhiteListRepository
{
    public function isExist(string $value): bool;
}