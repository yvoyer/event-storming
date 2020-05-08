<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

final class EventName
{
    /**
     * @var string
     */
    private $value;

    public function toString(): string
    {
        return $this->value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public static function fixture(): self
    {
        return self::fromString(\uniqid('Event name '));
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
