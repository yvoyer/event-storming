<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model\Schema;

use Star\EventStorming\Domain\Model\DomainEvent;
use Star\EventStorming\Domain\Model\EventTypeFactory;
use Star\EventStorming\Domain\Model\EventVisitor;

final class Schema
{
    /**
     * @var DomainEvent[][]
     */
    private $events = [];

    /**
     * @var EventTypeFactory
     */
    private $factory;

    /**
     * @param EventTypeFactory $factory
     */
    public function __construct(EventTypeFactory $factory)
    {
        $this->factory = $factory;
    }

    public function addEvent(string $type, string $name): void
    {
        if ($this->hasEvent($type, $name)) {
            throw new EventAlreadyExists($type, $name);
        }

        $this->events[$type][$name] = $this->factory->createType($type)->createEvent($name);
    }

    public function hasEvent(string $type, string $name): bool
    {
        return isset($this->events[$type][$name]);
    }

    public function acceptEventVisitor(EventVisitor $visitor): void
    {
        foreach ($this->events as $type => $events) {
            foreach ($events as $event) {
                $event->acceptEventVisitor($visitor);
            }
        }
    }
}
