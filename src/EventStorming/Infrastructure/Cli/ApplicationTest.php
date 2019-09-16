<?php declare(strict_types=1);

namespace Star\EventStorming\Infrastructure\Cli;

use PHPUnit\Framework\TestCase;
use Star\EventStorming\Domain\Model\EventAggregate;
use Star\EventStorming\Infrastructure\Persistence\InMemory\EventCollection;
use Symfony\Component\Console\Tester\ApplicationTester;

final class ApplicationTest extends TestCase
{
    /**
     * @var ApplicationTester
     */
    private $tester;

    /**
     * @var EventCollection
     */
    private $events;

    public function setUp(): void
    {
        $application = new Application($this->events = new EventCollection());
        $application->setAutoExit(false);
        $this->tester = new ApplicationTester($application);
    }

    public function test_it_create_basic_event(): void
    {
        $this->assertCount(0, $this->events);

        $this->runCommand('event:create', ['name' => 'Event was created']);

        $this->assertNotNull($this->tester->getDisplay());
        $this->assertCount(1, $this->events);
    }

    public function test_it_rename_event(): void
    {
        $this->markTestIncomplete('todo');
        $this->events->saveEvent($event = EventAggregate::fixture());

        $this->runCommand(
            'event:rename'#,
  #          [
               # 'id' => $event->getId()->toString(),
   #             'name' => 'Event was created',
    #        ]
        );

        $this->assertContains(
            'Event was renamed from "" to "".',
            $this->tester->getDisplay()
        );
    }

    private function runCommand(string $name, array $args = []): void
    {
        $this->assertSame(
            0,
            $this->tester->run(\array_merge(['command' => $name], $args)),
            $this->tester->getDisplay()
        );
    }
}
