<?php

namespace Deft\Filesystem;

use DateTime;
use Deft\Filesystem\Reading\FileContent;
use Deft\Filesystem\Reading\FileStream;
use Rhumsaa\Uuid\Uuid;

class File
{
    /** @var string */
    private $id;
    public function getId() { return$this->id; }

    /** @var string */
    private $directory;

    /** @var string */
    private $filename;

    /** @var string */
    private $mimeType;

    /** @var FileCreator */
    private $fileCreator;

    /** @var DateTime */
    private $createdAt;

    /** @var DateTime */
    private $updatedAt;

    /** @var DateTime|null */
    private $deletedAt;

    public function __construct($directory, $filename, $mimeType, FileCreator $fileCreator)
    {
        $this->id = Uuid::uuid1();
        $this->directory = $directory;
        $this->filename = $filename;
        $this->mimeType = $mimeType;
        $this->fileCreator = $fileCreator;

        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function remove() { $this->deletedAt = new DateTime(); }

    public function getPath() { return $this->directory . '/' . $this->id; }

    public function getFileContent($content)
    {
        return new FileContent($content, $this->getMetadata());
    }

    public function getFileStream($stream)
    {
        return new FileStream($stream, $this->getMetadata());
    }

    public function getMetadata()
    {
        return new Reading\FileMetadata($this->id, $this->directory, $this->filename, $this->mimeType, $this->createdAt);
    }

}
