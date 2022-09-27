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


        $form = $this->createFormBuilder($vybraneJidlo);
        $tage=['Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag','Sonntag'];
        foreach($tage as $tag){

            $form->add('fruhstuck' . $tag, EntityType::class,
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

                ->add('snack' . $tag, EntityType::class,
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
                ->add('mittagessen' . $tag, EntityType::class,
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
                ->add('abendsbrot' . $tag, EntityType::class,
                    [
                        'class' => NazevJidla::class,
                        'choice_label' => 'nazev',
                        'label' => 'Abendsbrot',
                        'mapped' => false,
                        'multiple' => false,
                        'expanded' => false,
                        'placeholder' => '',
                    ]
                );
        }

            $form->add('submit', SubmitType::class, ['label' => 'Speichern']);


        $montag = date('d.m.Y', strtotime('sunday next week'));
        $sonntag = date('d.m.Y', strtotime('sunday next week'));

        return $this->renderForm('tydenni_jidelnicek/index.html.twig', [

           'form' => $form->getForm(),
            'montag' => $montag,
            'sonntag' => $sonntag,
            'tage' => $tage

        ]);
    }



}