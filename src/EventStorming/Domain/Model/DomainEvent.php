<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

interface DomainEvent
{
    /**
     * @param EventVisitor $visitor
     */
    public function acceptEventVisitor(EventVisitor $visitor): void;
}
