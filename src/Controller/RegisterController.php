<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignupType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     */
    public function index(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();

        $form = $this->createForm(SignupType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_USER']);

            $password = $hasher->hashPassword($user, $user->getPassword());

            $user->setPassword($password);

            $doctrine->persist($user);

            $doctrine->flush();

            return $this->redirectToRoute("home");
        }

        return $this->renderForm('register/index.html.twig', [
            'form' => $form
        ]);
    }
}
