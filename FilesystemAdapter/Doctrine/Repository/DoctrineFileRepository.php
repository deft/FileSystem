<?php

namespace Deft\FilesystemAdapter\Doctrine\Repository;

use Deft\Filesystem\File;
use Deft\Filesystem\FileNotFound;
use Deft\Filesystem\FileRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use RuntimeException;

class DoctrineFileRepository implements FileRepository
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function get($id)
    {
        if (!$file = $this->getEntityManager()->find(File::class, $id))
            throw FileNotFound::create($id);

        return $file;
    }

    public function add(File $file)
    {
        $this->getEntityManager()->persist($file);
        $this->getEntityManager()->flush();
    }

    private function getEntityManager()
    {
        if (!$em = $this->managerRegistry->getManagerForClass(File::class))
            throw new RuntimeException(sprintf('No manager found for %s', File::class));

        return $em;
    }
}
