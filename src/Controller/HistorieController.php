<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistorieController extends AbstractController
{
    #[Route('/historie', name: 'app_historie')]
    public function index(): Response
    {
        return $this->render('historie/index.html.twig', [
            'controller_name' => 'HistorieController',
        ]);
    }
}
