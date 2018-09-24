<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

final class SystemEventType implements EventType
{
    /**
     * @param string $name
     *
     * @return DomainEvent
     */
    public function createEvent(string $name): DomainEvent
    {
        return new SystemEvent($name);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return 'system';
    }
}
