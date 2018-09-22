<?php declare(strict_types=1);

namespace Star\Infrastructure\Cli;

use Star\EventStorming\Domain\Model\ChainEventTypeFactory;
use Star\Schema\Json\JsonDumper;
use Star\Schema\Json\JsonLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

final class EventStormCommand extends Command
{
    const NAME = 'event:configure';

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var SymfonyStyle
     */
    private $output;

    /**
     * @var string
     */
    private $path;

    public function __construct(string $path = null)
    {
        if (! $path) {
            $path = realpath(__DIR__ . '/../../../events.json');
        }

        $this->path = (string) $path;
        parent::__construct(self::NAME);
    }

    protected function configure()
    {
        $this->addArgument('event', InputArgument::REQUIRED, 'The event name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = new SymfonyStyle($input, $output);
        $this->output->title("Welcome to the tool for generation event.");

        $type = $this->ask(
            new ChoiceQuestion(
                "What is the type for this event? <comment>[User event]</comment>",
                [
                    'User',
                    'System',
                ],
                0
            )
        );

        $data = '[]';
        if (\file_exists($this->path)) {
            $data  = (string) \file_get_contents($this->path);
        }

        $loader = new JsonLoader();
        $schema = $loader->load(new ChainEventTypeFactory(), $data);
        $schema->addEvent($type, $input->getArgument('event'));

        $dumper = new JsonDumper();
        $this->output->write($dumpData = $dumper->dump($schema));

        $confirmation = $this->ask(
            new ConfirmationQuestion("\nIs this correct <info>[y|n]</info>? <comment>[y]</comment>")
        );
        if (! $confirmation) {
            $this->output->warning('The changes were not applied...');
            return 1;
        }

        \file_put_contents($this->path, $dumpData);
        $this->output->success(sprintf('Wrote file: "%s".', $this->path));

        return 0;
    }

    private function ask(Question $question)
    {
        /**
         * @var QuestionHelper $helper
         */
        $helper = $this->getHelper('question');
        return $helper->ask($this->input, $this->output, $question);
    }
}
