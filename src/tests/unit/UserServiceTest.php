<?php

namespace Tests\unit;

use App\Entities\User;
use App\Repositories\SqlUserRepository;
use App\Services\UserService;
use Codeception\Test\Unit;
use Exception;
use Respect\Validation\Factory;
use Tests\Log\MemoryLogger;
use Tests\UnitTester;

class UserServiceTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    /**
     * @dataProvider validateDataProvider
     * @param $user
     * @param $expected
     * @throws Exception
     */
    public function testValidate($user, $expected)
    {
        Factory::setDefaultInstance(
            (new Factory())
                ->withRuleNamespace('\\Tests\\Validation\\Rules\\')
                ->withExceptionNamespace('\Tests\\Validation\\Exceptions')
        );

        $service = $this->make(UserService::class, ['getRepository' => $this->make(SqlUserRepository::class)]);
        $this->tester->assertEquals($expected, array_keys($service->validate($user)));
    }

    public function validateDataProvider(): array
    {
        return [
            [new User(null, 'maria', 'maria@gmail.com'), ['name']],
            [new User(null, str_repeat('m', 65), 'maria@gmail.com'), ['name']],
            [new User(null, 'anastasia', 'maria@gmail.com'), []],
            [new User(), ['name', 'email']],
            [new User(null, 'anastasia', 'mariagmail.com'), ['email']],
        ];
    }

    public function testSave()
    {
        $newUserId = 100;
        $repository = $this->make(SqlUserRepository::class, ['create' => $newUserId, 'update' => true]);

        //insert
        $logger = new MemoryLogger();
        $service = $this->construct(UserService::class, [$repository, $logger], ['validate' => []]);
        $this->tester->assertTrue($service->save(new User(null, str_repeat('a', 9), 'hello@example.com')));
        $this->tester->assertCount(1, $logger->messages);

        //update
        $logger = new MemoryLogger();
        $service = $this->construct(UserService::class, [$repository, $logger], ['validate' => []]);
        $this->tester->assertTrue($service->save(new User($newUserId, str_repeat('a', 9), 'hello@example.com')));
        $this->tester->assertCount(1, $logger->messages);

        //invalid
        $logger = new MemoryLogger();
        $service = $this->construct(UserService::class, [$repository, $logger], ['validate' => ['name']]);
        $this->tester->assertFalse($service->save(new User($newUserId, str_repeat('a', 9), 'hello@example.com')));
        $this->tester->assertCount(0, $logger->messages);
    }

    public function testSaveFail()
    {
        $newUserId = 100;
        $repository = $this->make(SqlUserRepository::class, ['create' => 0, 'update' => false]);
        $logger = new MemoryLogger();
        $service = $this->construct(UserService::class, [$repository, $logger], ['validate' => []]);

        //insert
        $this->tester->assertFalse($service->save(new User(null, str_repeat('a', 9), 'hello@example.com')));
        $this->tester->assertCount(0, $logger->messages);

        //update
        $this->tester->assertFalse($service->save(new User($newUserId, str_repeat('a', 9), 'hello@example.com')));
        $this->tester->assertCount(0, $logger->messages);
    }

    public function testDelete()
    {
        $repository = $this->make(SqlUserRepository::class, ['safeDelete' => true]);

        //success
        $logger = new MemoryLogger();
        $service = $this->construct(UserService::class, [$repository, $logger]);
        $this->tester->assertTrue($service->delete(new User(1)));
        $this->tester->assertCount(1, $logger->messages);

        //fail
        $logger = new MemoryLogger();
        $repository = $this->make(SqlUserRepository::class, ['safeDelete' => false]);
        $service = $this->construct(UserService::class, [$repository, $logger]);
        $this->tester->assertFalse($service->delete(new User(null)));
        $this->tester->assertCount(0, $logger->messages);
    }
}