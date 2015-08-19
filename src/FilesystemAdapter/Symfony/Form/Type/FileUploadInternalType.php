<?php

namespace Deft\FilesystemAdapter\Symfony\Form\Type;

use Deft\FilesystemAdapter\Symfony\Form\DataTransformer\UploadedFileToFileIdTransformerFactory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileUploadInternalType extends abstractType
{
    private $transformerFactory;

    function __construct(UploadedFileToFileIdTransformerFactory $transformerFactory)
    {
        $this->transformerFactory = $transformerFactory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer($this->transformerFactory->createTransformer($options['directory']));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(['directory']);
    }

    public function getParent() { return 'file'; }
    public function getName() { return 'deft_file_upload_internal'; }
}
