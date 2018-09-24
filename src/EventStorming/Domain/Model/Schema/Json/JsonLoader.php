<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model\Schema\Json;

use Star\EventStorming\Domain\Model\EventTypeFactory;
use Star\EventStorming\Domain\Model\Schema\Schema;
use Star\EventStorming\Domain\Model\Schema\SchemaLoader;

final class JsonLoader implements SchemaLoader
{
    /**
     * @param EventTypeFactory $factory
     * @param string $string
     *
     * @return Schema
     */
    public function load(EventTypeFactory $factory, string $string): Schema
    {
        $data = \json_decode($string, true);
        if (! is_array($data)) {
            throw new InvalidJsonFormat(
                sprintf(
                    'Invalid Json data provided, data must be an object, "%s" supplied.',
                    $string
                )
            );
        }
        $schema = new Schema($factory);

        foreach ($data as $stringType => $events) {
            foreach ($events as $eventData) {
                $schema->addEvent($stringType, $eventData['name']);
            }
        }

        return $schema;
    }
}
