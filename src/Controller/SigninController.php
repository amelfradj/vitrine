<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\SigninType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


final class SigninController extends AbstractController
{
    #[Route('/signin', name: 'app_signin')]
    public function index(
        Request $req,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = new User();
        $form = $this->createForm(SigninType::class, $user);
        $form->handleRequest($req);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
    
            $entityManager->persist($user);
            $entityManager->flush();
    
            $this->addFlash('success', 'Votre compte a bien été créé');
            return $this->redirectToRoute('app_home'); // Redirigez vers une route appropriée.
        }
    
        return $this->render('signin/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
