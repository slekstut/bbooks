<?php

namespace App\Form;

use App\Entity\Knyga;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KnygaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Enter the book title',
                    'class' => 'form-input rounded border-gray-300 w-full',
                ],
            ])
            ->add('author', TextType::class, [
                'label' => 'Author',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Enter the author\'s name',
                    'class' => 'form-input rounded border-gray-300 w-full',
                ],
            ])
            ->add('publishedDate', DateType::class, [
                'label' => 'Published Date',
                'widget' => 'single_text',
                'html5' => true,   
                'input' => 'datetime',       
                'attr' => [
                    'class' => 'form-input rounded border-gray-300 w-full',
                ],
            ])
            ->add('isbn', TextType::class, [
                'label' => 'ISBN',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter the ISBN (optional)',
                    'class' => 'form-input rounded border-gray-300 w-full',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter a brief description of the book (optional)',
                    'rows' => 5,
                    'class' => 'form-textarea rounded border-gray-300 w-full',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Knyga::class,
        ]);
    }
}
