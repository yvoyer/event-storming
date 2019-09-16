<?php declare(strict_types=1);

namespace Star\EventStorming\Infrastructure\Persistence\InMemory;

use Star\EventStorming\Domain\Model\DomainEvent;
use Star\EventStorming\Domain\Model\EventAggregate;
use Star\EventStorming\Domain\Model\EventId;
use Star\EventStorming\Domain\Model\EventRepository;

final class EventCollection implements EventRepository, \Countable
{
    /**
     * @var DomainEvent[][]
     */
    private $events = [];

    public function getEventById(EventId $id): EventAggregate
    {
        if (! $this->aggregateExists($id)) {
            throw new \RuntimeException(
                \sprintf('Event with id "%s" could not be found.', $id->toString())
            );
        }

        $root = EventAggregate::fromStream($this->events[$id->toString()]);
        $root->uncommitedEvents();

        return $root;
    }

    public function saveEvent(EventAggregate $event): void
    {
        $id = $event->getId();
        if (! $this->aggregateExists($id)) {
            $this->events[$id->toString()] = [];
        }

        foreach ($event->uncommitedEvents() as $_event) {
            $this->events[$id->toString()][] = $_event;
        }
    }

    final private function aggregateExists(EventId $id): bool
    {
        return \array_key_exists($id->toString(), $this->events);
    }

    public function count(): int
    {
        return \count($this->events);
    }
}
