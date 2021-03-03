<?php


namespace Tests;

use PHPUnit\Framework\TestCase;

class UserTestCase extends TestCase
{
    protected function getUserData(): array
    {
        return [
            "id" => 1,
            "name" => "pavel",
            "email" => "bilpavel@gmail.com",
            "notes" => "hello",
            "created" => "2000-01-01 15:15:15",
            "deleted" => null
        ];
    }
}