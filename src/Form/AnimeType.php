<?php

namespace App\Form;

use App\Entity\Anime;
use App\Entity\Genre;
use App\Entity\StatutAnime;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('year')
            ->add('synopsis')
            ->add('imageURL')
//            ->add('favoris', EntityType::class, [
//                'class' => User::class,
//                'choice_label' => 'name',
//                'multiple' => true,
//            ])
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('statut_anime', EntityType::class, [
                'class' => StatutAnime::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Anime::class,
        ]);
    }
}
