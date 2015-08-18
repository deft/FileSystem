<?php

namespace Deft\Filesystem;

interface FileCreatorProvider
{
    /** @return FileCreator */
    public function getFileCreator();
}
