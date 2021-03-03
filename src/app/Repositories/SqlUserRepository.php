<?php


namespace App\Repositories;


use App\Entities\User;
use PDO;
use Exception;

class SqlUserRepository implements UserRepository
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
     * @return bool
     */
    public function create(User $user): bool
    {
        $sql = "INSERT INTO `{$this->getTableName()}` (`name`, `email`, `created`, `deleted`, `notes`) 
                VALUES (:name, :email, :created, null, :notes)";
        $params = $this->prepareParams($user);
        $params['created'] = $user->getCreated()->format('Y-m-d H:i:s');
        return $this->connection->prepare($sql)->execute($params);
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
            'deleted' => $user->getDeleted()->format('Y-m-d H:i:s')
        ];
        return $this->connection->prepare($sql)->execute($params);
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
}