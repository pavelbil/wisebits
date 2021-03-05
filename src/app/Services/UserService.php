<?php


namespace App\Services;


use App\Entities\User;
use App\Repositories\QueryRepository;
use App\Repositories\UserRepository;
use Psr\Log\LoggerInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Factory;
use Respect\Validation\Validatable;
use Respect\Validation\Validator as v;

class UserService
{
    /**
     * @var UserRepository
     */
    protected UserRepository $repository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(UserRepository $repository, LoggerInterface $logger)
    {
        $this->repository = $repository;
        $this->setLogger($logger);
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        return [];
    }

    public function save(): bool
    {
        $this->writeLog('User updated');
        return true;
    }

    protected function getRepository(): QueryRepository
    {
        return $this->repository;
    }

    public function validate(User $user): array
    {
        try {
            Factory::setDefaultInstance(
                (new Factory())
                    ->withRuleNamespace('App\\Validation\\Rules')
                    ->withExceptionNamespace('App\\Validation\\Exceptions')
            );
            $userValidator = v::attribute('name', $this->getNameValidationRules())
                ->attribute('email', $this->getEmailValidationRules());

            $userValidator->assert($user);
        } catch (NestedValidationException $e) {
            return $e->getMessages();
        }

        return [];
    }

    protected function getNameValidationRules(): Validatable
    {
        return v::alnum()
            ->notEmpty()
            ->noWhitespace()
            ->length(8, 64);
    }

    protected function getEmailValidationRules(): Validatable
    {
        return v::email()
            ->notEmpty()
            ->lessThan(255);
        //->uniqueValue($this->getRepository(), 'email');
    }

    protected function writeLog($message): void
    {
        $this->logger->info($message);
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}