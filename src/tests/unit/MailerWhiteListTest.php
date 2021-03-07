<?php

namespace Tests\unit;

use App\Validation\Rules\MailerWhiteList;
use Codeception\Test\Unit;
use Tests\Repository\MemoryWhiteListRepositoryInterface;
use Tests\UnitTester;

class MailerWhiteListTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    /**
     * @var MailerWhiteList
     */
    protected MailerWhiteList $rule;


    /**
     * @dataProvider validateDataProvider
     * @param string $value
     * @param bool $expected
     * @throws \Exception
     */
    public function testValidate(string $value, bool $expected)
    {
        $rule = $this->make(
            MailerWhiteList::class,
            ['repository' => $this->make(MemoryWhiteListRepositoryInterface::class, ['isExist' => function ($email) {
                return $email === 'gmail.com';
            }])]);
        $this->tester->assertEquals($expected, $rule->validate($value));
    }

    public function validateDataProvider(): array
    {
        return [
            ['hello@gmail.com', true],
            ['hello@yandex.ru', false],
            ['gmail.com', false],
        ];
    }

    /**
     * @dataProvider getMailerDataProvider
     * @param $expected
     * @param $email
     * @throws \Exception
     */
    public function testGetMailerByEmail($expected, $email)
    {
        $rule = $this->make(MailerWhiteList::class);
        $this->assertEquals($expected, $rule->getMailerByEmail($email));
    }

    public function getMailerDataProvider(): array
    {
        return [
            ['gmail.com', 'example@gmail.com'],
            ['yandex.ru', 'example@yandex.ru'],
            ['', 'google.ru'],
        ];
    }
}
