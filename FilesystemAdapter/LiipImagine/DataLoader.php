<?php

namespace Deft\FilesystemAdapter\LiipImagine;

use Deft\Filesystem\Reading\FileReader;
use League\Flysystem\FileNotFoundException;
use Liip\ImagineBundle\Binary\Loader\LoaderInterface;
use Liip\ImagineBundle\Binary\MimeTypeGuesserInterface;
use Liip\ImagineBundle\Model\Binary;

class DataLoader implements LoaderInterface
{
    private $fileReader;
    private $mimeTypeGuesser;

    public function __construct(FileReader $fileReader, MimeTypeGuesserInterface $mimeTypeGuesser)
    {
        $this->fileReader = $fileReader;
        $this->mimeTypeGuesser = $mimeTypeGuesser;
    }

    function find($id)
    {
        if (substr($id, -4) == '.jpg')
            $id = substr($id, 0, -4);

        if (!$id) throw new FileNotFoundException($id);
        $file = $this->fileReader->readContent($id);
        if (!$file) throw new FileNotFoundException($id);
        $mimeType = $file->getFile()->getMimeType() ?: $this->mimeTypeGuesser->guess($file->getContent());

        if (0 !== strpos($mimeType, 'image/')) return new Binary($file->getContent(), 'image/png', 'png');;
        return $file->getContent();
    }
}
