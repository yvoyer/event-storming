<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

final class UserEventType implements EventType
{
    /**
     * @param string $name
     *
     * @return DomainEvent
     */
    public function createEvent(string $name): DomainEvent
    {
        return new UserEvent($name);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return 'user';
    }
}
