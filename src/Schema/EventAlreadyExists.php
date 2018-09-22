<?php declare(strict_types=1);

namespace Star\Schema;

final class EventAlreadyExists extends \InvalidArgumentException
{
    /**
     * @param string $type
     * @param string $event
     */
    public function __construct(string $type, string $event)
    {
        parent::__construct(
            sprintf(
                'The event with name "%s" of type "%s" already exists.',
                $event,
                $type
            )
        );
    }
}
