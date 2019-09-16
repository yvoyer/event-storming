<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

use PHPUnit\Framework\TestCase;
use Star\EventStorming\Domain\Events\EventWasProposed;

final class EventAggregateTest extends TestCase
{
    public function test_it_should_create_basic_suggested_event(): void
    {
        $aggregate = EventAggregate::suggested(
            EventId::fromString('id'), EventName::fromString('name')
        );

        /**
         * @var EventWasProposed[] $events
         */
        $this->assertCount(1, $events = $aggregate->uncommitedEvents());
        $this->assertInstanceOf(EventWasProposed::class, $event = $events[0]);
        $this->assertSame('id', $event->eventId()->toString());
        $this->assertSame('name', $event->name()->toString());
    }
}
