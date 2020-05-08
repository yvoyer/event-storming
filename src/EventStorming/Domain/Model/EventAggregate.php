<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

use Star\Component\DomainEvent\AggregateRoot;
use Star\EventStorming\Domain\Events\EventWasProposed;

final class EventAggregate extends AggregateRoot
{
    /**
     * @var EventId
     */
    private $id;

    /**
     * @var EventName
     */
    private $name;

    public function getId(): EventId
    {
        return $this->id;
    }

    protected function onEventWasProposed(EventWasProposed $event): void
    {
        $this->id = $event->eventId();
        $this->name = $event->name();
    }

    public static function suggested(EventId $id, EventName $name): self
    {
        return self::fromStream([new EventWasProposed($id, $name)]);
    }

    public static function fixture(): self
    {
        return self::suggested(EventId::asUUID(), EventName::fixture());
    }
}
