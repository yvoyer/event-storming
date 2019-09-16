<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

interface EventRepository
{
    public function getEventById(EventId $id): EventAggregate;

    public function saveEvent(EventAggregate $event): void;
}
