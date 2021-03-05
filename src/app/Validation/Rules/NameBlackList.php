<?php

namespace App\Validation\Rules;

use App\Repositories\WhiteListRepository;
use Respect\Validation\Rules\AbstractRule;

/**
 * Class NameBlackList
 * @package App\Validation\Rules
 */
class NameBlackList extends AbstractRule
{

    /**
     * @var WhiteListRepository
     */
    private WhiteListRepository $repository;

    /**
     * NameBlackList constructor.
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
        return !$this->repository->isExist($input);
    }
}