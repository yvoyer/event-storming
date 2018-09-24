<?php declare(strict_types=1);

namespace Star\EventStorming\Infrastructure\Filesystem;

interface FileStream
{
    /**
     * @return string
     */
    public function getContents(): string;

    /**
     * @param string $string
     */
    public function putContents(string $string): void;

    /**
     * @return string
     */
    public function getPath(): string;
}
