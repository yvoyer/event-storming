<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

final class SystemEvent implements DomainEvent
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param EventVisitor $visitor
     */
    public function acceptEventVisitor(EventVisitor $visitor): void
    {
        $visitor->visitEvent($this->name, new SystemEventType());
    }
}
