<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

use PHPUnit\Framework\TestCase;

final class UserEventTest extends TestCase
{
    /**
     * @var UserEvent
     */
    private $event;

    public function setUp()
    {
        $this->event = new UserEvent('name');
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
