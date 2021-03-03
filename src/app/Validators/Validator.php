<?php
declare(strict_types=1);

namespace App\Validators;


use Exception;

class Validator
{
    /**
     * @param $value
     * @return bool
     * @throws Exception
     */
    public function validate($value): bool
    {
        $result = $this->validateValue($value);
        if ($result) {
            return true;
        }

        return false;
    }

    /**
     * @param $value
     * @return bool
     * @throws Exception
     */
    protected function validateValue($value): bool
    {
        throw new Exception(get_class($this) . ' does not support validateValue().');
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function getErrorMessage(): string
    {
        throw new Exception(get_class($this) . ' does not support getErrorMessage().');
    }

    /**
     * @param $name
     * @param $params
     * @return Validator
     * @throws Exception
     */
    public static function createValidator($name, $params): Validator
    {
        if (!class_exists($name)) {
            throw new Exception("Validator {$name} does not exist");
        }
        return new $name($params);
    }
}