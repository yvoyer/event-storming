<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

final class NullEvent implements DomainEvent
{
    /**
     * @param EventVisitor $visitor
     */
    public function acceptEventVisitor(EventVisitor $visitor): void
    {
        // do nothing
    }
}
