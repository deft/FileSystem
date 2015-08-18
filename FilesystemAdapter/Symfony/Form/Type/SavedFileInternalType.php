<?php

namespace Deft\FilesystemAdapter\Symfony\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SavedFileInternalType extends abstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) {
            $fileId = $event->getForm()->getParent()->get('fileId')->getNormData();
            if ($fileId) $event->setData($fileId);
        });
    }

    public function getParent() { return 'hidden'; }
    public function getName() { return 'deft_saved_file_internal'; }
}
