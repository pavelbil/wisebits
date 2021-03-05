<?php

namespace Tests\unit;

use App\Entities\User;
use App\Services\UserService;
use Codeception\Test\Unit;
use Exception;
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
        $service = $this->make(UserService::class);
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

    protected function setUp(): void
    {
        parent::setUp();
    }
}