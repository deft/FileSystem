<?php

namespace Deft\Filesystem\Reading;

class FileContent
{
    private $content;
    public function getContent() { return $this->content; }

    /** @var FileMetadata */
    private $file;
    public function getFile() { return $this->file; }

    public function __construct($content, FileMetadata $file)
    {
        $this->content = $content;
        $this->file = $file;
    }
}
