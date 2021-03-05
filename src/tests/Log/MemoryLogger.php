<?php


namespace Tests\Log;

use Psr\Log\LoggerInterface;

class MemoryLogger implements LoggerInterface
{
    public array $messages = [];

    public function emergency($message, array $context = array())
    {
        $this->messages[] = $message;
    }

    public function alert($message, array $context = array())
    {
        $this->messages[] = $message;
    }

    public function critical($message, array $context = array())
    {
        $this->messages[] = $message;
    }

    public function error($message, array $context = array())
    {
        $this->messages[] = $message;
    }

    public function warning($message, array $context = array())
    {
        $this->messages[] = $message;
    }

    public function notice($message, array $context = array())
    {
        $this->messages[] = $message;
    }

    public function info($message, array $context = array())
    {
        $this->messages[] = $message;
    }

    public function debug($message, array $context = array())
    {
        $this->messages[] = $message;
    }

    public function log($level, $message, array $context = array())
    {
        $this->messages[] = $message;
    }
}