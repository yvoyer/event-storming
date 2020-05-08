<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

use PHPUnit\Framework\TestCase;

final class SystemEventTest extends TestCase
{
    /**
     * @var SystemEvent
     */
    private $event;

    public function setUp()
    {
        $this->event = new SystemEvent('name');
    }

    public function test_it_should_visit_event()
    {
        $visitor = $this->createMock(EventVisitor::class);
        $visitor->expects($this->once())
            ->method('visitEvent')
            ->with('name');

        $this->event->acceptEventVisitor($visitor);
    }
}
