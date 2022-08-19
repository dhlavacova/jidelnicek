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

class JidelnicekController extends AbstractController
{
    #[Route('/jidelnicek', name: 'app_jidelnicek')]
    public function new(Request $request,EntityManagerInterface $em, ): Response
    {
        $jidlo = new NazevJidla();

        $form = $this->createFormBuilder($jidlo)
            ->add('nazev', TextType::class, ['label' => 'Nazev noveho receptu: ', 'trim'=>true])
            ->add('druhy', EntityType::class, ['class' => DruhJidla::class, 'choice_label' => 'nazev','mapped' => false, 'multiple' => true])
            ->add('submit', SubmitType::class, ['label' => 'Uloz'])
            ->getForm();
        // Zpracování editačního formuláře.
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $jidlo = $form->getData();
            $em->persist($jidlo); // nachystej - preklad pokracuj
            $em->flush($jidlo);
            $this->addFlash('notice', 'Článek byl úspěšně uložen.');
            return $this->redirectToRoute(($request->attributes->get('_route')));
        }
        //vykresleni formulare
        return $this->renderForm('jidelnicek/index.html.twig', [
            'form' => $form,
        ]);
    }}





