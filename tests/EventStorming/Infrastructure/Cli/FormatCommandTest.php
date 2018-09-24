<?php declare(strict_types=1);

namespace Star\EventStorming\Infrastructure\Cli;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\Constraint\JsonMatches;
use PHPUnit\Framework\TestCase;
use Star\EventStorming\Infrastructure\Filesystem\PhpFile;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Tester\CommandTester;

final class FormatCommandTest extends TestCase
{
    private const QUESTION_EVENT_TYPE = 'What is the type for this event? <comment>[User event]</comment>';
    private const QUESTION_CONFIRM = "\nIs this correct <info>[y|n]</info>? <comment>[y]</comment>";

    /**
     * @var CommandTester
     */
    private $tester;

    /**
     * @var vfsStreamDirectory
     */
    private $root;

    /**
     * @var FormatCommand
     */
    private $command;

    public function setUp()
    {
        $this->root = vfsStream::setup('root', null, ['actual.json' => '[]']);
        $this->tester = new CommandTester(
            $this->command = new FormatCommand(new PhpFile($this->root->getChild('actual.json')->url()))
        );
    }

    public function test_it_should_create_user_event_when_file_do_not_exists()
    {
        $root = vfsStream::setup('root');
        $tester = new CommandTester($command = new FormatCommand(new PhpFile($root->url() . '/data.json')));
        $command->setHelperSet(
            new HelperSet(
                [
                    new FakeQuestionHelper(
                        [
                            self::QUESTION_EVENT_TYPE => ['user'],
                            self::QUESTION_CONFIRM => ['y'],
                        ]
                    ),
                ]
            )
        );
        $tester->execute(['event' => 'new event']);
        $this->assertSame(0, $tester->getStatusCode());
        $this->assertContains(
            '[OK] Wrote file: "vfs://root/data.json".',
            $tester->getDisplay()
        );
    }

    public function test_it_should_load_from_existing_schema()
    {
        $this->assertQuestionsAreAsked(
            [
                self::QUESTION_EVENT_TYPE => ['user'],
                self::QUESTION_CONFIRM => ['y'],
            ]
        );
        $this->tester->execute(['event' => 'new event']);
        $this->assertSame(0, $this->tester->getStatusCode());
        $this->assertContains('[OK] Wrote file: "vfs://root/actual.json".', $this->tester->getDisplay());
    }

    public function test_it_should_add_system_event()
    {
        $this->assertQuestionsAreAsked(
            [
                self::QUESTION_EVENT_TYPE => ['system'],
                self::QUESTION_CONFIRM => ['y'],
            ]
        );
        $this->tester->execute(['event' => 'new event']);
        $this->assertSame(0, $this->tester->getStatusCode());
        $content = <<<STRING
{
    "system":
    [
        {
            "name": "new event",
            "type": "system"
        }
    ]
}
STRING;

        $this->assertFileContentEquals($content);
    }

    public function test_it_should_have_a_name()
    {
        $this->assertSame('format', $this->command->getName());
    }

    public function test_it_should_not_dump_file_when_cancelling_confirmation()
    {
        $this->assertQuestionsAreAsked(
            [
                self::QUESTION_EVENT_TYPE => ['user'],
                self::QUESTION_CONFIRM => [false],
            ]
        );
        $this->tester->execute(['event' => 'name']);
        $this->assertSame(1, $this->tester->getStatusCode());
        $this->assertContains('The changes were not applied...', $this->tester->getDisplay());
    }

    private function assertQuestionsAreAsked(array $questions): void
    {
        $this->command->setHelperSet(
            new HelperSet(
                [
                    new FakeQuestionHelper($questions),
                ]
            )
        );
    }

    private function assertFileContentEquals(string $expectedJson): void
    {
        $actualPath = $this->root->getChild('actual.json')->url();

        $this->assertJson($expectedJson);
        $this->assertFileExists($actualPath);
        $this->assertJson($actualJson = (string) \file_get_contents($actualPath));
        $this->assertThat($actualJson, new JsonMatches($expectedJson));
    }
}
