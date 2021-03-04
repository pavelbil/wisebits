<?php


namespace App\Services;


use App\Entities\User;
use App\Repositories\UserRepository;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Respect\Validation\Validator as v;

class UserService implements LoggerAwareInterface
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

    public function validate(User $user): bool
    {
        $usernameValidator = v::alnum()->notEmpty()->noWhitespace()->length(8, 64);
        $emailValidator = v::email()->notEmpty()->lessThan(255)->unique();

        return $usernameValidator->validate($user->getName()) && $emailValidator->validate($user->getEmail());
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