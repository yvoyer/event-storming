<?php declare(strict_types=1);

namespace Star\Infrastructure\Cli;

use PHPUnit\Framework\AssertionFailedError;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

final class FakeQuestionHelper extends Helper
{
    /**
     * @var array
     */
    private $expectedAnswers = [];

    /**
     * @param array $expectedAnswers Expected answer indexed by question
     */
    public function __construct(array $expectedAnswers)
    {
        $this->expectedAnswers = $expectedAnswers;
    }

    /**
     * Asks a question to the user.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param Question $question
     *
     * @return mixed
     */
    public function ask(InputInterface $input, OutputInterface $output, Question $question)
    {
        if (! array_key_exists($question->getQuestion(), $this->expectedAnswers)) {
            throw new AssertionFailedError(
                sprintf('Question "%s" do not have a registered answer.', $question->getQuestion())
            );
        }

        $answer = array_shift($this->expectedAnswers[$question->getQuestion()]);

        return $answer;
    }

    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     */
    public function getName()
    {
        return 'question';
    }
}
