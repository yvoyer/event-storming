<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

final class NullEventType implements EventType
{
    /**
     * @param string $name
     *
     * @return DomainEvent
     */
    public function createEvent(string $name): DomainEvent
    {
        return new NullEvent();
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return 'null-type';
    }
}
