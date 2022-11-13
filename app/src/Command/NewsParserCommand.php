<?php

namespace App\Command;

use App\Message\NewsParserMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class NewsParserCommand extends Command
{
    private MessageBusInterface $bus;
    protected static $defaultName = "app:parse-news";

    public function __construct(MessageBusInterface $bus, string $name = null)
    {
        parent::__construct($name);
        $this->bus = $bus;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // call new fetching api here
        $this->bus->dispatch(new NewsParserMessage("Parse News CLI"));
        return Command::SUCCESS;
    }
}
