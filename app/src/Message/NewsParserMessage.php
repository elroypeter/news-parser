<?php

namespace App\Message;

class NewsParserMessage
{
    private $message;

    public function __contruct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
