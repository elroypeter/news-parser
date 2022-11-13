<?php

namespace App\Handler;

use App\Message\NewsParserMessage;
use App\Service\NewsParserService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class NewsParserHandler implements MessageHandlerInterface
{
    private NewsParserService $newsParserService;

    public function __construct(NewsParserService $newsParserService)
    {
        $this->newsParserService = $newsParserService;
    }

    public function __invoke(NewsParserMessage $message)
    {
        $this->newsParserService->parseNews();
    }
}
