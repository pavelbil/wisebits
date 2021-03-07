<?php

namespace Tests\unit;

use App\Entities\User;
use App\Validation\Rules\UniqueValue;
use Codeception\Test\Unit;
use Tests\StubQueryRepositoryInterface;
use Tests\UnitTester;

class UniqueValueTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    /**
     * @var UniqueValue
     */
    protected UniqueValue $rule;


    /**
     * @dataProvider validateDataProvider
     * @param array $entities
     * @param int|null $id
     * @param bool $expected
     * @throws \Exception
     */
    public function testValidate(array $entities, ?int $id, bool $expected)
    {
        $rule = $this->construct(
            UniqueValue::class,
            ['repository' => $this->make(StubQueryRepositoryInterface::class), 'field' => 'email', 'id' => $id],
            ['findSimilarEntities' => $entities, 'getId' => $id]);
        $this->tester->assertEquals($expected, $rule->validate('hello@world.ru'));
    }

    public function validateDataProvider(): array
    {
        $id = 1;
        $entity = $this->make(User::class, ['getId' => $id]);
        return [
            [[$entity], null, false],
            [[$entity], $id, true],
            [[$entity], $id + 1, false],
            [[], $id, true],
            [[], null, true],
        ];
    }
}
