<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

interface EventType
{
    /**
     * @param string $name
     *
     * @return DomainEvent
     */
    public function createEvent(string $name): DomainEvent;

    /**
     * @return string
     */
    public function toString(): string;
}
