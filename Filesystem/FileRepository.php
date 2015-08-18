<?php

namespace Deft\Filesystem;

interface FileRepository
{
    /**
     * @return File
     * @throws FileNotFound
     */
    public function get($id);

    public function add(File $file);
}
