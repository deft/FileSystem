<?php

namespace Deft\Filesystem\Reading;

class FileMetadata
{
    private $id;
    public function getId() { return $this->id; }

    private $directory;
    public function getDirectory() { return $this->directory; }

    private $filename;
    public function getFilename() { return $this->filename; }

    private $mimeType;
    public function getMimeType() { return $this->mimeType; }

    private $createdAt;
    public function getCreatedAt() { return $this->createdAt; }

    function __construct($id, $directory, $filename, $mimeType, $createdAt)
    {
        $this->id = $id;
        $this->directory = $directory;
        $this->filename = $filename;
        $this->mimeType = $mimeType;
        $this->createdAt = $createdAt;
    }
}
