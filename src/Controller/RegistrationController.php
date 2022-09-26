<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function index(Request $request,EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $data = [];
        $form = $this->createFormBuilder($data)
            ->add('email',TextType::class,['label'=>'Email:', 'trim'=>true])
            ->add('password', PasswordType::class,[])
            ->add('submit', SubmitType::class, ['label' => 'Weiter'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = new User();
            $email = $data['email'];
            $plaintextPassword = $data['password'];

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $user->setEmail($email);

            $em->persist($user); // nachystej - preklad pokracuj
            $em->flush($user);
            $this->addFlash("success", "Uzivatel byl pridan");

            return $this->redirectToRoute('app_login');
        }
        return $this->renderForm('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
            'form' => $form,
        ]);
    }
}
