<?php

namespace Deft\Filesystem\Reading;

class FileStream
{
    private $stream;
    public function getStream() { return $this->stream; }

    /** @var FileMetadata */
    private $file;
    public function getFile() { return $this->file; }

    public function __construct($stream, FileMetadata $file)
    {
        $this->stream = $stream;
        $this->file = $file;
    }
}
