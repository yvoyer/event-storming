<?php declare(strict_types=1);

namespace Star\EventStorming\Infrastructure\Cli;

use Star\Component\DomainEvent\Messaging\MessageMapBus;
use Star\EventStorming\Domain\Commands\SuggestEvent;
use Star\EventStorming\Domain\Commands\SuggestEventHandler;
use Star\EventStorming\Domain\Model\EventRepository;
use Symfony\Component\Console\Application as SymfonyApplication;

final class Application extends SymfonyApplication
{
    private const VERSION = '0.1.0';

    public function __construct(EventRepository $events)
    {
        parent::__construct('Event storming', self::VERSION);
        $bus = new MessageMapBus();

        $bus->registerHandler(
            SuggestEvent::class,
            new SuggestEventHandler($events)
        );

        $this->addCommands(
            [
                new EventCreateCommand($bus),
            ]
        );
    }
}
