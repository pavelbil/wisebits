<?php

namespace App\Validation\Rules;

use App\Repositories\QueryRepositoryInterface;
use Respect\Validation\Rules\AbstractRule;

class UniqueValue extends AbstractRule
{

    private QueryRepositoryInterface $repository;
    private string $field;
    private ?int $id;

    public function __construct(QueryRepositoryInterface $repository, string $field, ?int $id = null)
    {
        $this->repository = $repository;
        $this->field = $field;
        $this->id = $id;
    }


    public function validate($input): bool
    {
        $entities = $this->findSimilarEntities($input);

        if (count($entities) == 0) {
            return true;
        } elseif (empty($this->getId())) {
            return false;
        }

        $entity = reset($entities);
        if (count($entities) == 1 && $this->getId() == $entity->getId()) {
            return true;
        }

        return false;
    }

    protected function findSimilarEntities($input): array
    {
        return $this->repository->findBy([
            $this->field => $input
        ]);
    }

    /**
     * @return int|null
     */
    protected function getId(): ?int
    {
        return $this->id;
    }
}