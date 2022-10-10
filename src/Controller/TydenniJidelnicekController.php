<?php

namespace App\Controller;

use App\Entity\DruhJidla;
use App\Entity\Historie;
use App\Entity\NazevJidla;
use App\Repository\HistorieRepository;
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

    public function new(Request $request , EntityManagerInterface $em, HistorieRepository $historieRepository): Response
    {
        $data=[];
        $form = $this->createFormBuilder($data);
        $tage=['Montag'=>'monday', 'Dienstag'=>'tuesday','Mittwoch'=>'wednesday', 'Donnerstag'=>'thursday','Freitag'=>'friday', 'Samstag'=>'saturday', 'Sonntag'=>'sunday'];
        foreach($tage as $tag){

            $form->add('fruhstuck' . $tag, EntityType::class,
                [
                    'class' => NazevJidla::class,
                    'choice_label' => 'nazev',
                    'label' => 'Frühstück',
                    'multiple' => false,
                    'expanded' => false,
                    'placeholder' => '',
                    'required' => false,
                ]
            )

                ->add('snack' . $tag, EntityType::class,
                    [
                        'class' => NazevJidla::class,
                        'choice_label' => 'nazev',
                        'label' => 'Snack',
                        'multiple' => false,
                        'expanded' => false,
                        'placeholder' => '',
                        'required' => false,
                    ]
                )
                ->add('mittagessen' . $tag, EntityType::class,
                    [
                        'class' => NazevJidla::class,
                        'choice_label' => 'nazev',
                        'label' => 'Mittagessen',
                        'multiple' => false,
                        'expanded' => false,
                        'placeholder' => '',
                        'required' => false,
                    ]
                )
                ->add('abendsbrot' . $tag, EntityType::class,
                    [
                        'class' => NazevJidla::class,
                        'choice_label' => 'nazev',
                        'label' => 'Abendsbrot',
                        'multiple' => false,
                        'expanded' => false,
                        'placeholder' => '',
                        'required' => false, // povinne ulozeni neni (ulozi to prazdne policko)
                    ]
                );
        }

            $form->add('submit', SubmitType::class, ['label' => 'Speichern']);


        $montag = date('d.m.Y', strtotime('monday next week'));
        $sonntag = date('d.m.Y', strtotime('sunday next week'));

        $form = $form->getForm();
        $form->handleRequest($request);//zpracuj dotaz. zpracuje vstpy
        if ($form->isSubmitted() && $form->isValid()) { //pokud je formular poslany a pokud je platny
            $data = $form->getData();

            foreach ($tage as $tag => $day) {
                $datum = new \DateTime($day . ' next week');
                $historie = $historieRepository->findOneBy(['datum' => $datum]); // Z databaze vytahni hodnotu v historii
                if ($historie === null) {
                    $historie = new Historie();
                }

                $fruehstueck = $data['fruhstuck'.$day];
                $snack = $data['snack'.$day];
                $mittagessen = $data['mittagessen'.$day];
                $abendsbrot = $data['abendsbrot'.$day];
                $historie->setFruestueck($fruehstueck);
                $historie->setSnack($snack);
                $historie->setmittagessen($mittagessen);
                $historie->setAbendsbrot($abendsbrot);
                $historie->setDatum($datum);
                $em->persist($historie);//rika doktrine, ze chcem ulozit produkt
                $em->flush();//vykona dotaz INSERT - vlozi dotaz do databaze
            }



            return $this->redirectToRoute(($request->attributes->get('_route')));
        }

        return $this->renderForm('tydenni_jidelnicek/index.html.twig', [

           'form' => $form,
            'montag' => $montag,
            'sonntag' => $sonntag,
            'tage' => $tage

        ]);
    }



}