<?php

namespace App\Controller;

use App\Entity\NazevJidla;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class JidelnicekController extends AbstractController
{
    #[Route('/jidelnicek', name: 'app_jidelnicek')]

    public function new(Request $request): ResponseAlias
    {
        // creates a task object and initializes some data for this example



        return $this->render('jidelnicek/index.html.twig', [
          'controller_name' => 'JidelnicekController',
        'form'=>'form',
      ]);
    }
}


