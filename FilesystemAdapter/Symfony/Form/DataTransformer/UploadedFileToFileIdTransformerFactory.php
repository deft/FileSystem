<?php

namespace Deft\FilesystemAdapter\Symfony\Form\DataTransformer;

use Deft\Filesystem\Writing\FileWriter;

class UploadedFileToFileIdTransformerFactory
{
    private $fileWriter;

    public function __construct(FileWriter $fileWriter)
    {
        $this->fileWriter = $fileWriter;
    }

    public function createTransformer($directory)
    {
        return new UploadedFileToFileIdTransformer($this->fileWriter, $directory);
    }
}
