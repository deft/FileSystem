<?php

namespace Deft\Filesystem;

class FileCreator
{
    protected $fqcn;
    public function getFqcn() { return $this->fqcn; }

    protected $id;
    public function getId() { return $this->id; }

    public static function anonymous() { return new self(null, null); }

    public function __construct($fqcn, $id)
    {
        $this->fqcn = $fqcn;
        $this->id = $id;
    }

    public function isAnonymous() { return $this->fqcn == null && $this->id == null; }
}
