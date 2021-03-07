<?php


namespace App\Repositories;


use App\Entities\User;
use DateTime;
use Exception;
use PDO;

class SqlUserRepository implements UserRepositoryInterface
{
    private string $tableName = 'users';
    protected PDO $connection;

    /**
     * MysqlUserRepository constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get user list
     * @return User[]
     * @throws Exception
     */
    public function findAll(): array
    {
        $users = $this->connection->query("SELECT * FROM `{$this->getTableName()}`");
        $result = [];

        foreach ($users as $user) {
            $result[] = User::fromState($user);
        }
        return $result;
    }

    /**
     * Update user
     * @param User $user
     * @return bool
     * @throws Exception
     */
    public function update(User $user): bool
    {
        if (empty($user->getId())) {
            throw new Exception('Id must not be empty');
        }

        $sql = "UPDATE `{$this->getTableName()}` SET `name` = :name, `email` = :email, `notes` = :notes WHERE id = :id";
        $params = $this->prepareParams($user);
        $params['id'] = $user->getId();
        return $this->connection->prepare($sql)->execute($params);
    }

    /**
     * Table name
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * Create user
     * @param User $user
     * @return int
     */
    public function create(User $user): int
    {
        $sql = "INSERT INTO `{$this->getTableName()}` (`name`, `email`, `created`, `deleted`, `notes`) 
                VALUES (:name, :email, :created, null, :notes)";
        $params = $this->prepareParams($user);
        $params['created'] = $this->generateCreated();
        $this->connection->prepare($sql)->execute($params);
        return (int)$this->connection->lastInsertId($this->tableName);
    }

    protected function generateCreated(): string
    {
        return (new DateTime)->format('Y-m-d H:i:s');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function safeDelete(User $user): bool
    {
        $sql = "UPDATE `{$this->getTableName()}` SET `deleted` = :deleted WHERE id = :id";
        $params = [
            'id' => $user->getId(),
            'deleted' => $this->generateDeleted()
        ];
        return $this->connection->prepare($sql)->execute($params);
    }

    protected function generateDeleted(): string
    {
        return (new DateTime())->format('Y-m-d H:i:s');
    }

    /**
     * Prepare params for query
     * @param User $user
     * @return array
     */
    protected function prepareParams(User $user): array
    {
        return [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'notes' => $user->getNotes()
        ];
    }

    public function findById(int $id): ?User
    {
        $users = $this->connection->prepare("SELECT * FROM `{$this->getTableName()}` WHERE id = ?");

        $users->execute([$id]);

        foreach ($users->fetchAll() as $user) {
            return User::fromState($user);
        }
        return null;
    }

    /**
     * @param array $criteria
     * @return User[]
     */
    public function findBy(array $criteria): array
    {
        $params = [];
        $condition = [];
        foreach ($criteria as $key => $value) {
            if ($value == null) {
                $condition[] = "`{$key}` IS NULL";
                continue;
            }
            $condition[] = "`{$key}` = ?";
            $params[] = $value;
        }

        $users = $this->connection->prepare("SELECT * FROM `{$this->getTableName()}` WHERE " . implode(' AND ', $condition));
        $users->execute($params);

        $result = [];
        foreach ($users->fetchAll() as $user) {
            $result[] = User::fromState($user);
        }

        return $result;
    }
}