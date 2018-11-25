<?php declare(strict_types=1);

namespace Star\EventStorming\EventDefinition\Domain\Events;

use Star\EventStorming\EventDefinition\Domain\Model\EventId;
use Star\EventStorming\EventDefinition\Domain\Model\EventName;
use Star\EventStorming\EventDefinition\Domain\Model\ModelerId;
use Star\EventStorming\EventDefinition\Domain\Model\OccurrenceDate;

final class EventWasSubmitted
{
    /**
     * @var EventId
     */
    private $eventId;

    /**
     * @var EventName
     */
    private $eventName;

    /**
     * @var ModelerId
     */
    private $modeler;

    /**
     * @var OccurrenceDate
     */
    private $occuredAt;
}
