<?php

namespace Deft\FilesystemAdapter\Flysystem;

use Deft\Filesystem\Reading\ReadFailed;
use Deft\Filesystem\Reading\StorageReader;
use League\Flysystem\Filesystem;

class FlysystemStorageReader implements StorageReader
{
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function readContent($path)
    {
        try { if ($result = $this->filesystem->read($path)) return $result; }
        catch (\Exception $e) { }

        throw new ReadFailed('Failed to read file from storage');
    }

    public function readStream($path)
    {
        try { if ($result = $this->filesystem->readStream($path)) return $result; }
        catch (\Exception $e) { }

        throw new ReadFailed('Failed to read file from storage');
    }
}
