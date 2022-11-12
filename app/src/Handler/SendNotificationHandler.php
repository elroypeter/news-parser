<?php

namespace App\Handler;

use App\Message\SendNotificationMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SendNotificationHandler implements MessageHandlerInterface
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(SendNotificationMessage $message)
    {
        // run saving login here
        sleep(5);
    }
}