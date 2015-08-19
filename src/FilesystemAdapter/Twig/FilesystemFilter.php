<?php

namespace Deft\FilesystemAdapter\Twig;

use Deft\Filesystem\FileNotFound;
use Deft\Filesystem\Reading\FileReader;

class FilesystemFilter extends \Twig_Extension
{
    private $fileReader;

    public function __construct(FileReader $fileReader)
    {
        $this->fileReader = $fileReader;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('file_metadata', [$this, 'fileMetadataFilter'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('file_metadata_filename', [$this, 'fileMetadataFilenameFilter'], ['is_safe' => ['html']])
        ];
    }

    public function fileMetadataFilter($fileId)
    {
        try { return $this->fileReader->getMetadata($fileId); }
        catch (FileNotFound $e) { return null; }
    }

    public function fileMetadataFilenameFilter($fileId)
    {
        try { return $this->fileReader->getMetadata($fileId)->getFilename(); }
        catch (FileNotFound $e) { return null; }
    }

    public function getName()
    {
        return 'deft_filesystem';
    }
}
