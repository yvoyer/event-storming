<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

use PHPUnit\Framework\TestCase;

final class ChainEventTypeFactoryTest extends TestCase
{
    /**
     * @var ChainEventTypeFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ChainEventTypeFactory();
    }

    public function test_it_should_throw_exception_when_type_not_supported()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Event type "invalid" is not supported yet.');
        $this->factory->createType('invalid');
    }

    public function test_it_should_return_system_event_type()
    {
        $this->assertInstanceOf(SystemEventType::class, $this->factory->createType('system'));
    }

    public function test_it_should_return_user_event_type()
    {
        $this->assertInstanceOf(UserEventType::class, $this->factory->createType('user'));
    }

    public function test_it_should_lower_case_type()
    {
        $this->assertInstanceOf(UserEventType::class, $this->factory->createType('UsEr'));
    }
}
