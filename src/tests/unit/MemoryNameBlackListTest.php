<?php

namespace Tests\unit;


use App\Repositories\MemoryNameBlackList;

class MemoryNameBlackListTest extends \Codeception\Test\Unit
{
    /**
     * @var \Tests\UnitTester
     */
    protected $tester;

    /**
     * @dataProvider isExistDataProvider
     * @param $expected
     * @param $name
     */
    public function testIsExist($expected, $name)
    {
        $blackList = new MemoryNameBlackList();
        $this->tester->assertEquals($expected, $blackList->isExist($name));
    }

    public function isExistDataProvider(): array
    {
        return [
            [true, 'pavel001'],
            [false, 'pavel'],
            [false, ''],
        ];
    }
}