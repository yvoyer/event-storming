<?php declare(strict_types=1);

namespace Star\EventStorming\Infrastructure\Filesystem;

final class PhpFile implements FileStream
{
    /**
     * @var string
     */
    private $path;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
        if (! \file_exists($path)) {
            $this->putContents('{}');
        }
    }

    /**
     * @return string
     */
    public function getContents(): string
    {
        $contents = \file_get_contents($this->path);
        if (! $contents) {
            var_dump($contents);
        }

        return $contents;
    }

    /**
     * @param string $string
     */
    public function putContents(string $string): void
    {
        \file_put_contents($this->path, $string);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
