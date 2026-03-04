<?php

namespace App\Form;

use App\Entity\Editeur;
use App\Entity\Jeu;
use App\Repository\EditeurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $codePostal = $options['codePostal'];
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du jeu '
            ])
            ->add('prix', IntegerType::class, [
                'label' => 'Prix du jeu '
            ])
            ->add('photo1', FileType::class, [
                'mapped' => false,
            ])
            ->add('editeur', EntityType::class, [
                'label' => 'Editeur du jeu ',
                'class' => Editeur::class,
                'choice_label' => 'nom',
                'query_builder' => function (EditeurRepository $er) use ($codePostal) {
                    return $er->createQueryBuilder('e')
                        ->where('e.cp = :codePostal')
                        ->setParameter('codePostal', $codePostal);
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jeu::class,
            'codePostal' => '',
            'translation_domain' => 'form'
        ]);
    }
}
