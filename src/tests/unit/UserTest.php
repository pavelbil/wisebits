<?php
namespace Tests\unit;

use App\Entities\User;
use Helper\Unit;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \Tests\UnitTester
     */
    protected $tester;

    /**
     * @var array
     */
    private array $userData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userData = [
            "id" => 1,
            "name" => "pavel",
            "email" => "example@gmail.com",
            "notes" => "hello",
            "created" => "2000-01-01 15:15:15",
            "deleted" => null
        ];
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
            ['name' => 'notes', 'data' => 'lorem ipsum']
        ];
    }

    public function testGetId()
    {
        $user = $this->createUserModel();
        $this->tester->assertEquals($this->userData['id'], $user->getId());
    }
}