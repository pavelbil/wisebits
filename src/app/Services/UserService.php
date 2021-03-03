<?php


namespace App\Services;


use App\Entities\User;
use App\Repositories\UserRepository;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

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
        return true;
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