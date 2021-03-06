<?php

namespace App\Validation\Rules;

use App\Repositories\WhiteListRepository;
use Respect\Validation\Rules\AbstractRule;

/**
 * Class ExistsValue
 * @package App\Validation\Rules
 */
class ExistsValue extends AbstractRule
{

    /**
     * @var WhiteListRepository
     */
    protected WhiteListRepository $repository;

    /**
     * ExistsValue constructor.
     * @param WhiteListRepository $repository
     */
    public function __construct(WhiteListRepository $repository)
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