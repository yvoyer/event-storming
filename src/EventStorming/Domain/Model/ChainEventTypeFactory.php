<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

final class ChainEventTypeFactory implements EventTypeFactory
{
    /**
     * @param string $type
     *
     * @return EventType
     */
    public function createType(string $type): EventType
    {
        $type = strtolower($type);
        switch ($type) {
            case 'system':
                return new SystemEventType();

            case 'user':
                return new UserEventType();
        }

        throw new \InvalidArgumentException(
            sprintf(
                'Event type "%s" is not supported yet.',
                $type
            )
        );
    }
}
