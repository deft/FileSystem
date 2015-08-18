<?php

namespace Deft\FilesystemAdapter\Symfony\Form\Type;

use Deft\FilesystemAdapter\Symfony\Form\DataTransformer\DeletableTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileUploadType extends abstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fileId', 'deft_file_upload_internal', ['directory' => $options['directory']])
            ->add('isDeleted', 'hidden')
            ->add('savedFileId', new SavedFileInternalType())
            ->addViewTransformer(new DeletableTransformer())
            ->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
                $data = $event->getData();
                if (isset($data['fileId']) && $data['fileId']) $data['isDeleted'] = false;
                $event->setData($data);
            })
        ;
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['file_id'] = $form->get('savedFileId')->getNormData();
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(['directory']);
    }

    public function getName() { return 'deft_file_upload'; }
}
