<?php

namespace App\Controller;

use App\Entity\DruhJidla;
use App\Entity\NazevJidla;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class TydenniJidelnicekController extends AbstractController
{
    #[Route('/tydenni/jidelnicek', name: 'app_tydenni_jidelnicek')]
    public function new(Request $request): Response
    {
        $vybraneJidlo = new NazevJidla();


        $form = $this->createFormBuilder($vybraneJidlo)
            ->add('montag', EntityType::class,
                [
                    'class' => NazevJidla::class,
                    'choice_label' => 'nazev',
                    'label' => 'Frühstück',
                    'mapped' => false,
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => '',
                ]
            )

            ->add('utery', EntityType::class,
                [
                    'class' => NazevJidla::class,
                    'choice_label' => 'nazev',
                    'label' => 'Snack',
                    'mapped' => false,
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => '',
                ]
            )
            ->add('streda', EntityType::class,
                [
                    'class' => NazevJidla::class,
                    'choice_label' => 'nazev',
                    'label' => 'Mittagessen',
                    'mapped' => false,
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => '',
                ]
            )
            ->add('ctvrtek', EntityType::class,
                [
                    'class' => NazevJidla::class,
                    'choice_label' => 'nazev',
                    'label' => 'Abendsbrot',
                    'mapped' => false,
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => '',
                ]
            )
//            ->add('patek', EntityType::class,
//                [
//                    'class' => NazevJidla::class,
//                    'choice_label' => 'nazev',
//                    'label' => 'Patek',
//                    'mapped' => false,
//                    'multiple' => false,
//                    'expanded' => false,
//                    'placeholder' => '',
//                ]
//            )
            ->add('submit', SubmitType::class, ['label' => 'Speichern'])
            ->getForm();


        $montag = date('d.m.Y', strtotime('sunday next week'));
        $sonntag = date('d.m.Y', strtotime('sunday next week'));

        return $this->renderForm('tydenni_jidelnicek/index.html.twig', [
           'form' => $form,
            'montag' => $montag,
            'sonntag' => $sonntag,

        ]);
    }



}