<?php

namespace Deft\FilesystemAdapter\Symfony\Form\DataTransformer;

use Deft\Filesystem\Writing\FileWriter;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadedFileToFileIdTransformer implements DataTransformerInterface
{
    private $fileWriter;
    private $directory;

    public function __construct(FileWriter $fileWriter, $directory)
    {
        $this->fileWriter = $fileWriter;
        $this->directory = $directory;
    }

    public function transform($value)
    {
        return null;
    }

    public function reverseTransform($value)
    {
        if (!$value instanceof UploadedFile) return null;

        return (string) $this->fileWriter->writeStream(
            $this->directory,
            fopen($value->getPathname(), 'r'),
            $value->getClientOriginalName(),
            $value->getMimeType()
        );
    }
}
