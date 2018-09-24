<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model\Schema\Json;

use Star\EventStorming\Domain\Model\EventType;
use Star\EventStorming\Domain\Model\EventVisitor;
use Star\EventStorming\Domain\Model\Schema\Schema;
use Star\EventStorming\Domain\Model\Schema\SchemaDumper;

final class JsonDumper implements EventVisitor, SchemaDumper
{
    /**
     * @var array
     */
    private $data = [];

    public function dump(Schema $schema): string
    {
        $this->data = [];
        $schema->acceptEventVisitor($this);

        $format = new JsonFormatter();

        $json = \strval(\json_encode($this->data));

        return $format->format($json);
    }

    /**
     * @param string $name
     * @param EventType $type
     */
    public function visitEvent(string $name, EventType $type): void
    {
        $this->data[$type->toString()][] = [
            'name' => $name,
            'type' => $type->toString(),
        ];
    }
}
