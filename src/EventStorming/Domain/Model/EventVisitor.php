<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

interface EventVisitor
{
    /**
     * @param string $name
     * @param EventType $type
     */
    public function visitEvent(string $name, EventType $type): void;
}
