<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model\Schema\Json;

use PHPUnit\Framework\TestCase;
use Star\EventStorming\Domain\Model\AlwaysCreateEvent;
use Star\EventStorming\Domain\Model\EventTypeFactory;
use Star\EventStorming\Domain\Model\NullEventType;

final class JsonLoaderTest extends TestCase
{
    /**
     * @var JsonLoader
     */
    private $loader;

    public function setUp()
    {
        $this->loader = new JsonLoader();
    }

    public function test_it_should_throw_exception_when_empty_data()
    {
        $this->expectException(InvalidJsonFormat::class);
        $this->expectExceptionMessage('Invalid Json data provided, data must be an object, "" supplied.');
        $this->loader->load($this->createMock(EventTypeFactory::class), '');
    }

    public function test_it_should_load_the_events()
    {
        $schema = $this->loader->load(
            new AlwaysCreateEvent(new NullEventType()),
            '{"type":[{"name":"name"}]}'
        );
        $this->assertTrue($schema->hasEvent('type', 'name'));
    }
}
