<?php


namespace App\Repositories;


use App\Entities\User;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function findAll(): array;

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool;

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool;

    /**
     * @param User $user
     * @return bool
     */
    public function safeDelete(User $user): bool;
}