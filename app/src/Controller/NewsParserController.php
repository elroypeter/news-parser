<?php

namespace App\Controller;

use App\Message\NewsParserMessage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsParserController extends AbstractController
{
    #[Route('/send-message', name: 'send_message')]
    public function sendMessage(MessageBusInterface $bus): Response
    {
        $bus->dispatch(new NewsParserMessage("Parse News From Controller"));
        return new Response('');
    }
}
