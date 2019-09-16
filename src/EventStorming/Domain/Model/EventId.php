<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model;

use Ramsey\Uuid\Uuid;

final class EventId
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

    public static function asUUID(): self
    {
        return self::fromString(Uuid::uuid4()->toString());
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
