<?php

namespace App\Form;

use App\Entity\Movies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class MoviesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du film',
                'attr' => [
                    'placeholder' => 'Nom du film',
                ],
            ])
            ->add('releaseDate',DateType::Class, array(
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y')-100),
                'months' => range(1, 12),
                'days' => range(1, 31),
                'label' => 'Date de sortie',
                'attr' => [
                    'placeholder' => 'Date de sortie',
                ],
            ))
            ->add('synopsis', null, [
                'label' => 'Synopsis',
                'attr' => [
                    'placeholder' => 'Synopsis',
                ],
            ])
            ->add('duration', null, [
                'label' => 'Durée',
                'attr' => [
                    'placeholder' => 'Durée',
                ],
            ])
            ->add('picture', FileType::class, [
                'label' => 'Image de couverture',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new Image([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Le format de l\'image doit être soit : png, jpg ou jpeg',
                    ])
                ],
            ])
            ->add('category', null, [
                'label' => 'Catégorie',
                'attr' => [
                    'placeholder' => 'Catégorie',
                ],
            ])
            ->add('actors', null, [
                'label' => 'Acteurs',
                'attr' => [
                    'placeholder' => 'Acteurs',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movies::class,
        ]);
    }
}
