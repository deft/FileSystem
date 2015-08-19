<?php

namespace Deft\Filesystem\Writing;

interface StorageWriter
{
    public function writeContent($path, $content);

    public function writeStream($path, $stream);
}
