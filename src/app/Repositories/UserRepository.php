<?php


namespace App\Repositories;


use App\Entities\User;

interface UserRepository
{
    /**
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User;

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
     * Return added user id
     * @param User $user
     * @return int
     */
    public function create(User $user): int;

    /**
     * @param User $user
     * @return bool
     */
    public function safeDelete(User $user): bool;
}