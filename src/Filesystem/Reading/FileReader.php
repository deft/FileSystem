<?php

namespace Deft\Filesystem\Reading;

use Deft\Filesystem\FileNotFound;
use Deft\Filesystem\FileRepository;

class FileReader
{
    private $storageReader;
    private $fileRepository;

    public function __construct(StorageReader $storageReader, FileRepository $fileRepository)
    {
        $this->storageReader = $storageReader;
        $this->fileRepository = $fileRepository;
    }

    /**
     * @param string $id
     * @return FileMetadata
     * @throws FileNotFound
     */
    public function getMetadata($id)
    {
        return $this->fileRepository->get($id)->getMetadata();
    }

    /**
     * @param string $id
     * @return FileContent
     * @throws FileNotFound
     */
    public function readContent($id)
    {
        $file = $this->fileRepository->get($id);

        return $file->getFileContent($this->storageReader->readContent($file->getPath()));
    }

    /**
     * @param string $id
     * @return FileStream
     * @throws FileNotFound
     */
    public function readStream($id)
    {
        $file = $this->fileRepository->get($id);

        return $file->getFileStream($this->storageReader->readStream($file->getPath()));
    }
}
