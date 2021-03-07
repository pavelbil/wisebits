<?php

namespace App\Validation\Rules;

use App\Repositories\WhiteListRepositoryInterface;
use Respect\Validation\Rules\AbstractRule;

/**
 * Class ExistsValue
 * @package App\Validation\Rules
 */
class ExistsValue extends AbstractRule
{

    /**
     * @var WhiteListRepositoryInterface
     */
    protected WhiteListRepositoryInterface $repository;

    /**
     * ExistsValue constructor.
     * @param WhiteListRepositoryInterface $repository
     */
    public function __construct(WhiteListRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input): bool
    {
        return $this->repository->isExist($input);
    }
}