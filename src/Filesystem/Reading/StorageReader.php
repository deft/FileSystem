<?php

namespace Deft\Filesystem\Reading;

interface StorageReader
{
    /** @return string */
    public function readContent($path);

    /** @return resource */
    public function readStream($path);
}
