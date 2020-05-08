<?php declare(strict_types=1);

namespace Star\EventStorming\Infrastructure\Cli;

use Star\Component\DomainEvent\Messaging\CommandBus;
use Star\EventStorming\Domain\Commands\SuggestEvent;
use Star\EventStorming\Domain\Model\EventId;
use Star\EventStorming\Domain\Model\EventName;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class EventCreateCommand extends Command
{
    /**
     * @var CommandBus
     */
    private $bus;

    public function __construct(CommandBus $bus)
    {
        parent::__construct('event:create');
        $this->bus = $bus;
    }

    protected function configure(): void
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'The unique name of the event.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus->dispatchCommand(
            new SuggestEvent(
                $id = EventId::asUUID(),
                EventName::fromString($input->getArgument('name'))
            )
        );

        $output->writeln($id->toString());

        return 0;
    }
}
