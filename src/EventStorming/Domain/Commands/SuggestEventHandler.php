<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Commands;

use Star\EventStorming\Domain\Model\EventAggregate;
use Star\EventStorming\Domain\Model\EventRepository;

final class SuggestEventHandler
{
    /**
     * @var EventRepository
     */
    private $events;

    public function __construct(EventRepository $events)
    {
        $this->events = $events;
    }

    public function __invoke(SuggestEvent $command): void
    {
        // todo event with same name should not exists
        $this->events->saveEvent(
            EventAggregate::suggested($command->eventId(), $command->name())
        );
    }
}
