<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

interface EventTypeFactory
{
    /**
     * @param string $type
     *
     * @return EventType
     */
    public function createType(string $type): EventType;
}
