<?php


namespace App\Services;


use App\Entities\User;
use App\Repositories\QueryRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\WhiteListRepositoryInterface;
use Psr\Log\LoggerInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Factory;
use Respect\Validation\Validator as v;

/**
 * Service for user manipulation
 *
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $repository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(UserRepositoryInterface $repository, LoggerInterface $logger, WhiteListRepositoryInterface $nameRepository, WhiteListRepositoryInterface $mailerRepository)
    {
        $this->repository = $repository;
        $this->setLogger($logger);
        $this->nameRepository = $nameRepository;
        $this->mailerRepository = $mailerRepository;

        Factory::setDefaultInstance(
            (new Factory())
                ->withRuleNamespace('App\\Validation\\Rules')
                ->withExceptionNamespace('App\\Validation\\Exceptions')
        );
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function save(User $user): bool
    {
        if (count($this->validate($user)) !== 0) {
            return false;
        }

        if ($user->getId() && !$this->getRepository()->update($user)) {
            return false;
        }

        if (!$this->getRepository()->create($user)) {
            return false;
        }

        $this->writeLog('User has been changed');
        return true;
    }

    public function delete(User $user): bool
    {
        if (!$this->getRepository()->safeDelete($user)) {
            return false;
        }

        $this->writeLog('User has been deleted');
        return true;
    }

    protected function getRepository(): QueryRepositoryInterface
    {
        return $this->repository;
    }

    public function validate(User $user): array
    {
        try {
            $userValidator = v::attribute(
                'name',
                v::alnum()->notEmpty()->noWhitespace()->length(8, 64)->nameWhiteList($this->getNameWhiteListRepository())
            )
                ->attribute(
                    'email',
                    v::email()->notEmpty()->lessThan(255)->uniqueValue($this->getRepository(), 'email')->mailerWhiteList($this->getMailerBlackListRepository())
                );

            $userValidator->assert($user);
        } catch (NestedValidationException $e) {
            return $e->getMessages();
        }

        return [];
    }

    protected function getNameWhiteListRepository(): WhiteListRepositoryInterface
    {
        return $this->nameRepository;
    }

    protected function getMailerBlackListRepository(): WhiteListRepositoryInterface
    {
        return $this->mailerRepository;
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