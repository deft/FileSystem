<?php

namespace Deft\FilesystemAdapter\Symfony\Security;

use Deft\Filesystem\FileCreator;
use Deft\Filesystem\FileCreatorProvider;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TokenStorageFileCreatorProvider implements FileCreatorProvider
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getFileCreator()
    {
        if (null === $token = $this->tokenStorage->getToken()) return FileCreator::anonymous();
        if (!is_object($user = $token->getUser())) return FileCreator::anonymous();

        return new FileCreator(get_class($user), $user->getId());
    }
}
