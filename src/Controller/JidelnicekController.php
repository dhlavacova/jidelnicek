<?php

namespace App\Controller;

use App\Entity\DruhJidla;
use App\Entity\NazevJidla;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class JidelnicekController extends AbstractController
{
    #[Route('/jidelnicek', name: 'app_jidelnicek')]
    public function new(Request $request): Response
    {
        $jidlo = new NazevJidla();

        $form = $this->createFormBuilder($jidlo)
            ->add('nazev', TextType::class, ['label' => 'Nazev noveho receptu:'])
            ->add('druhy', EntityType::class, ['class' => DruhJidla::class, 'choice_label' => 'nazev','mapped' => false])
            ->add('submit', SubmitType::class, ['label' => 'Uloz'])
            ->getForm();

        //vykresleni formulare
        return $this->renderForm('jidelnicek/index.html.twig', [
            'form' => $form,
        ]);
    }

//vykresleni sablony
//    public function index(NazevJidla $nazevJidla): Response
//    {
//        return $this->render('jidelnicek/index.html.twig', [
//            'controller_name' => 'JidelnicekController',
//            'form'=>'form',
//        ]);
//    }
}





