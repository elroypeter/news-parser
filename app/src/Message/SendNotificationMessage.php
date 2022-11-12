<?php

namespace App\Message;

class SendNotificationMessage
{
    private string $text;

    public function __contruct(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}