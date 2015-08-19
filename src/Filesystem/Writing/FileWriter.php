<?php

namespace Deft\Filesystem\Writing;

use Deft\Filesystem\File;
use Deft\Filesystem\FileCreatorProvider;
use Deft\Filesystem\FileRepository;

class FileWriter
{
    private $fileCreatorProvider;
    private $fileRepository;
    private $storageWriter;

    public function __construct (FileCreatorProvider $fileCreatorProvider, FileRepository $fileRepository, StorageWriter $storageWriter)
    {
        $this->fileCreatorProvider = $fileCreatorProvider;
        $this->fileRepository = $fileRepository;
        $this->storageWriter = $storageWriter;
    }

    public function writeContent($directory, $content, $filename, $mimeType = null)
    {
        $file = $this->createFile($directory, $filename, $mimeType);
        $this->storageWriter->writeContent($file->getPath(), $content);

        return $file->getId();
    }

    public function writeStream($directory, $stream, $filename, $mimeType = null)
    {
        $file = $this->createFile($directory, $filename, $mimeType);
        $this->storageWriter->writeStream($file->getPath(), $stream);

        return $file->getId();
    }

    public function overwriteFileContent($fileId, $content)
    {
        $file = $this->fileRepository->get($fileId);
        $this->storageWriter->writeContent($file->getPath(), $content);
    }

    public function overwriteFileStream($fileId, $stream)
    {
        $file = $this->fileRepository->get($fileId);
        $this->storageWriter->writeStream($file->getPath(), $stream);
    }

    private function createFile($directory, $filename, $mimeType)
    {
        $file = new File($directory, $filename, $mimeType, $this->fileCreatorProvider->getFileCreator());
        $this->fileRepository->add($file);

        return $file;
    }
}
