<?php

namespace Deft\FilesystemAdapter\Symfony\Security;

use Deft\Filesystem\FileCreator;
use Deft\Filesystem\FileCreatorProvider;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityContextFileCreatorProvider implements FileCreatorProvider
{
    private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function getFileCreator()
    {
        if (null === $token = $this->securityContext->getToken()) return FileCreator::anonymous();
        if (!is_object($user = $token->getUser())) return FileCreator::anonymous();

        return new FileCreator(get_class($user), $user->getId());
    }
}
