<?php declare(strict_types=1);

namespace Star\EventStorming\Infrastructure\Filesystem;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

final class PhpFileTest extends TestCase
{
    public function test_it_should_create_empty_file_when_path_do_not_exists()
    {
        $root = vfsStream::setup();
        $file = new PhpFile($root->url() . '/file.json');

        $this->assertFileExists($root->url() . '/file.json');
        $this->assertSame('{}', $file->getContents());
    }

    public function test_it_should_have_a_path()
    {
        $root = vfsStream::setup('root', null, ['file.json' => '{}']);
        $file = new PhpFile($root->getChild('file.json')->url());
        $this->assertFileExists($file->getPath());
    }

    public function test_it_should_put_content()
    {
        $root = vfsStream::setup('root', null, ['file.json' => '{}']);
        $file = new PhpFile($root->getChild('file.json')->url());

        $file->putContents('some content');

        $this->assertSame('some content', \file_get_contents($root->getChild('file.json')->url()));
    }
}
