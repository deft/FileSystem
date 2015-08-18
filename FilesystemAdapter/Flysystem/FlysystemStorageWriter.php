<?php

namespace Deft\FilesystemAdapter\Flysystem;

use Deft\Filesystem\Writing\StorageWriter;
use Deft\Filesystem\Writing\WriteFailed;
use League\Flysystem\Filesystem;

class FlysystemStorageWriter implements StorageWriter
{
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function writeContent($path, $content)
    {
        try { if ($bool = $this->filesystem->put($path, $content)) return $bool; }
        catch (\Exception $e) { }

        throw new WriteFailed('Failed to write file to storage');
    }

    public function writeStream($path, $stream)
    {
        try { if ($bool = $this->filesystem->putStream($path, $stream)) return $bool; }
        catch (\Exception $e) { }

        throw new WriteFailed('Failed to write file to storage');
    }
}
