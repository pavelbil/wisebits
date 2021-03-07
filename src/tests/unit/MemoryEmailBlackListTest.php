<?php

namespace Tests\unit;


use App\Repositories\MemoryEmailBlackList;

class MemoryEmailBlackListTest extends \Codeception\Test\Unit
{
    /**
     * @var \Tests\UnitTester
     */
    protected $tester;

    /**
     * @dataProvider isExistDataProvider
     * @param $expected
     * @param $mailer
     */
    public function testIsExist($expected, $mailer)
    {
        $blackList = new MemoryEmailBlackList();
        $this->tester->assertEquals($expected, $blackList->isExist($mailer));
    }

    public function isExistDataProvider(): array
    {
        return [
            [true, 'mail.ru'],
            [false, 'google.com'],
            [false, ''],
        ];
    }
}