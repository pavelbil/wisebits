<?php

namespace Tests\Entities;

use App\Entities\User;
use Tests\UserTestCase;

class UserTest extends UserTestCase
{
    /**
     * @var array
     */
    private array $userData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userData = $this->getUserData();
    }

    protected function createUserModel(): User
    {
        return new User(
            $this->userData['id'],
            $this->userData['name'],
            $this->userData['email'],
            new \DateTime($this->userData['created']),
            $this->userData['deleted'],
            $this->userData['notes']
        );
    }

    /**
     * @dataProvider setterDataProvider
     * @param $name
     * @param $data
     * @param $expected
     */
    public function testSetters($name, $data)
    {
        $user = $this->createUserModel();
        $user->{'set' . lcfirst($name)}($data);
        $this->assertSame($data, $user->{'get' . lcfirst($name)}());
    }

    public function setterDataProvider(): array
    {
        return [
            ['name' => 'name', 'data' => 'ivan'],
            ['name' => 'email', 'data' => 'hello@world.ru'],
            ['name' => 'notes', 'data' => 'lorem ipsum'],
            ['name' => 'created', 'data' => new \DateTime()],
            ['name' => 'deleted', 'data' => new \DateTime()]
        ];
    }

    public function testGetId()
    {
        $user = $this->createUserModel();
        $this->assertEquals($this->userData['id'], $user->getId());
    }
}
