<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model\Schema\Json;

use PHPUnit\Framework\TestCase;
use Star\EventStorming\Domain\Model\AlwaysCreateEvent;
use Star\EventStorming\Domain\Model\Schema\Schema;
use Star\EventStorming\Domain\Model\UserEventType;

final class JsonDumperTest extends TestCase
{
    /**
     * @var JsonDumper
     */
    private $dumper;

    /**
     * @var Schema
     */
    private $schema;

    public function setUp()
    {
        $this->dumper = new JsonDumper();
        $this->schema = new Schema(new AlwaysCreateEvent(new UserEventType()));
    }

    public function test_it_should_dump_empty_schema()
    {
        $this->assertSame('[]', $this->dumper->dump($this->schema));
    }

    public function test_it_should_dump_events()
    {
        $this->schema->addEvent('type', 'name');
        $this->assertSame(
            <<<EXPECTED
{
    "user": [
        {
            "name": "name",
            "type": "user"
        }
    ]
}
EXPECTED
            ,
            $this->dumper->dump($this->schema)
        );
    }
}
