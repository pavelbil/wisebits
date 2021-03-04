<?php

namespace Tests\unit;

use App\Entities\User;
use App\Repositories\SqlUserRepository;
use Codeception\Test\Unit;
use DateTime;
use Exception;
use PDO;
use Tests\UnitTester;

class SqlUserRepositoryTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;
    /**
     * @var SqlUserRepository
     */
    private SqlUserRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $pdo = new PDO('sqlite:tests/_data/users.sqlite');
        $this->repository = new SqlUserRepository($pdo);
    }

    public function testFindAll()
    {
        $this->tester->seeNumRecords(count($this->repository->findAll()), 'users');
    }

    public function testCreate()
    {
        $user = new User();
        $user->setName('pavel');
        $user->setEmail('example@mail.ru');
        $userId = $this->repository->create($user);
        $this->tester->assertNotEquals(0, $userId);
        $this->tester->seeInDatabase('users', ['id' => $userId]);
    }

    /**
     * @dataProvider findByIdDataProvider
     * @param $id
     * @param $expected
     */
    public function testFindById($id, $expected)
    {
        $user = $this->repository->findById($id);

        if (!empty($user)) {
            $this->tester->assertInstanceOf($expected, $user);
        } else {
            $this->tester->assertEquals($expected, $user);
        }
    }

    public function findByIdDataProvider(): array
    {
        return [
            [10, User::class],
            ['10', User::class],
            [0, null],
            [5456, null]
        ];
    }

    public function testSafeDelete()
    {
        $user = new User(1);
        $deleted = (new DateTime())->format('Y-m-d H:i:s');
        $this->make(SqlUserRepository::class, ['generateDelete' => $deleted]);
        $this->repository->safeDelete($user);
        $this->tester->seeInDatabase('users', ['id' => 1, 'deleted' => $deleted]);
    }

    public function testUpdate()
    {
        $id = 1;
        $this->tester->seeInDatabase('users', ['id' => $id, 'name' => 'tcochran0']);
        $user = $this->repository->findById($id);
        $user->setName('ivan');
        $this->repository->update($user);
        $this->tester->seeInDatabase('users', ['id' => $id, 'name' => 'ivan']);
    }

    public function testUpdateException()
    {
        $this->tester->expectThrowable(Exception::class, function () {
            $user = new User(null, 'alexander');
            $this->repository->update($user);
        });
    }

    /**
     * @dataProvider findByDataProvider
     * @param $criteria
     */
    public function testFindBy($criteria)
    {
        $users = $this->repository->findBy($criteria);
        $this->tester->seeNumRecords(count($users), 'users', $criteria);


    }

    public function findByDataProvider(): array
    {
        return [
            [['id' => 1, 'name' => 'tcochran0']],
            [['deleted' => null]],
            [['email' => 'fake-email@gmail.com']]
        ];
    }
}