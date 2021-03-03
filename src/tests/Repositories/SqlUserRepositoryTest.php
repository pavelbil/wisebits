<?php

namespace Tests\Repositories;

use App\Entities\User;
use App\Repositories\SqlUserRepository;
use PDO;
use Tests\UserTestCase;

class SqlUserRepositoryTest extends UserTestCase
{
    public function testGetTableName()
    {
        $repository = new SqlUserRepository($this->createMock(PDO::class));
        $this->assertEquals('users', $repository->getTableName());
    }

    public function testUpdate()
    {
        $user = User::fromState($this->getUserData());

        $stmt = $this->createMock(\PDOStatement::class);
        $stmt->expects($this->once())
            ->method('execute')
            ->with([
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'notes' => $user->getNotes()
            ])
            ->willReturn(true);

        $fakePdo = $this->createMock(\PDO::class);
        $fakePdo->expects($this->once())
            ->method('prepare')
            ->with('UPDATE `users` SET `name` = :name, `email` = :email, `notes` = :notes WHERE id = :id')
            ->willReturn($stmt);


        $repository = new SqlUserRepository($fakePdo);

        $this->assertEquals(true, $repository->update($user));
    }

    public function testSafeDelete()
    {
        $user = User::fromState($this->getUserData());
        $deleted = new \DateTime();
        $user->setDeleted($deleted);

        $stmt = $this->createMock(\PDOStatement::class);
        $stmt->expects($this->once())
            ->method('execute')
            ->with([
                'id' => $user->getId(),
                'deleted' => $deleted->format('Y-m-d H:i:s')
            ])
            ->willReturn(true);

        $fakePdo = $this->createMock(\PDO::class);
        $fakePdo->expects($this->once())
            ->method('prepare')
            ->with('UPDATE `users` SET `deleted` = :deleted WHERE id = :id')
            ->willReturn($stmt);


        $repository = new SqlUserRepository($fakePdo);

        $this->assertEquals(true, $repository->safeDelete($user));
    }

    public function testCreate()
    {
        $user = $this->getUserModel();
        $created = new \DateTime();
        $user->setCreated($created);
        $stmt = $this->createMock(\PDOStatement::class);
        $stmt->expects($this->once())
            ->method('execute')
            ->with([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'notes' => $user->getNotes(),
                'created' => $created->format('Y-m-d H:i:s')
            ])
            ->willReturn(true);

        $fakePdo = $this->createMock(\PDO::class);
        $fakePdo->expects($this->once())
            ->method('prepare')
            ->with('INSERT INTO `users` (`name`, `email`, `created`, `deleted`, `notes`) 
                VALUES (:name, :email, :created, null, :notes)')
            ->willReturn($stmt);


        $repository = new SqlUserRepository($fakePdo);

        $this->assertEquals(true, $repository->create($user));
    }

    public function testFindAllEmpty()
    {
        $fakePdo = $this->createMock(\PDO::class);
        $fakePdo->expects($this->once())
            ->method('query')
            ->with("SELECT * FROM `users`")
            ->willReturn([]);


        $repository = new SqlUserRepository($fakePdo);

        $this->assertEquals([], $repository->findAll());
    }

    public function testFindAll()
    {

        $fakePdo = $this->createMock(\PDO::class);

        $fakePdo->expects($this->once())
            ->method('query')
            ->with("SELECT * FROM `users`")
            ->willReturn([
                $this->getUserData()
            ]);


        $repository = new SqlUserRepository($fakePdo);

        $this->assertCount(1, $repository->findAll());
    }

    protected function getUserModel(): User
    {
        return User::fromState($this->getUserData());
    }
}
