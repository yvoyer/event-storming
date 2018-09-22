<?php declare(strict_types=1);

namespace Star\Schema;

use PHPUnit\Framework\TestCase;
use Star\EventStorming\Domain\Model\AlwaysCreateEvent;
use Star\EventStorming\Domain\Model\EventType;
use Star\EventStorming\Domain\Model\EventTypeFactory;

final class SchemaTest extends TestCase
{
    /**
     * @var Schema
     */
    private $schema;

    /**
     * @var EventTypeFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new AlwaysCreateEvent($this->createMock(EventType::class));
        $this->schema = new Schema($this->factory);
    }

    public function test_it_should_add_event()
    {
        $this->assertFalse($this->schema->hasEvent('type', 'name'));
        $this->schema->addEvent('type', 'name');
        $this->assertTrue($this->schema->hasEvent('type', 'name'));
    }

    public function test_it_should_throw_exception_when_duplicate_event()
    {
        $this->schema->addEvent('type', 'duplicate');
        $this->expectException(EventAlreadyExists::class);
        $this->expectExceptionMessage('The event with name "duplicate" of type "type" already exists.');
        $this->schema->addEvent('type', 'duplicate');
    }
}
