<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Commands;

use Star\Component\DomainEvent\Messaging\Command;
use Star\EventStorming\Domain\Model\EventId;
use Star\EventStorming\Domain\Model\EventName;

final class SuggestEvent implements Command
{
    /**
     * @var EventId
     */
    private $id;

    /**
     * @var EventName
     */
    private $name;

    public function __construct(EventId $id, EventName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function eventId(): EventId
    {
        return $this->id;
    }

    public function name(): EventName
    {
        return $this->name;
    }
}
