<?php

namespace Deft\Filesystem;

use Exception;

class FileNotFound extends Exception
{
    public static function create($id, \Exception $previous = null)
    {
        return new self(sprintf("File with id '%s' not found", $id), 0, $previous);
    }
}
