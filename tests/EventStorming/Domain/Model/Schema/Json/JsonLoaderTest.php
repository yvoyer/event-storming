<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model\Schema\Json;

use PHPUnit\Framework\TestCase;
use Star\EventStorming\Domain\Model\EventTypeFactory;

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
}
