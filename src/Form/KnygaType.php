<?php

namespace App\Form;

use App\Entity\Knyga;
use Symfony\Component\Form\AbstractType;
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
            ])
            ->add('author', TextType::class, [
                'label' => 'Author',
            ])
            ->add('publishedDate', TextType::class, [
                'label' => 'Published Date',
                'required' => false,
            ])
            ->add('isbn', TextType::class, [
                'label' => 'ISBN',
                'required' => false,
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Knyga::class,
        ]);
    }
}
