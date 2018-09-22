<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

final class AlwaysCreateEvent implements EventTypeFactory
{
    /**
     * @var EventType
     */
    private $type;

    /**
     * @param EventType $type
     */
    public function __construct(EventType $type)
    {
        $this->type = $type;
    }

    /**
     * @param string $type
     *
     * @return EventType
     */
    public function createType(string $type): EventType
    {
        return $this->type;
    }
}
