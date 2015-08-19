<?php

namespace Deft\FilesystemAdapter\Symfony\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class DeletableTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        return ['fileId' => $value, 'isDeleted' => false, 'savedFileId' => $value];
    }

    public function reverseTransform($value)
    {
        return $value['fileId'] ?: ($value['isDeleted'] ? null : $value['savedFileId']);
    }
}
