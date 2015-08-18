<?php

namespace Deft\FilesystemAdapter\Swiftmailer;

use Deft\Filesystem\FileNotFound;
use Deft\Filesystem\Reading\FileReader;
use Deft\Filesystem\Reading\ReadFailed;

class AttachmentFactory
{
    /** @var FileReader $fileReader */
    private $fileReader;

    function __construct(FileReader $fileReader)
    {
        $this->fileReader = $fileReader;
    }

    public function createAttachment($fileId, $filename = null, $mimeType = null)
    {
        $file = $this->fileReader->readContent($fileId);

        return new \Swift_Attachment(
            $file->getContent(),
            $filename ?: $file->getFile()->getFilename(),
            $mimeType ?: $file->getFile()->getMimeType()
        );
    }

    public function createAttachmentIfExists($fileId, $filename = null, $mimeType = null)
    {
        if (!$fileId) return null;

        try {
            return $this->createAttachment($fileId, $filename, $mimeType);
        }
        catch (FileNotFound $e) { return null; }
        catch (ReadFailed $e) { return null; }
    }

    public function createImage($fileId)
    {
        $file = $this->fileReader->readContent($fileId);

        return new \Swift_Image($file->getContent(), $file->getFile()->getFilename(), $file->getFile()->getMimeType());
    }

    public function createImageIfExists($fileId)
    {
        if (!$fileId) return null;

        try {
            return $this->createImage($fileId);
        }
        catch (FileNotFound $e) { return null; }
        catch (ReadFailed $e) { return null; }
    }
}
