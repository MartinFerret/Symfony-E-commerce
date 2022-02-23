<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AccountPasswordController extends AbstractController
{
    /**
     * @Route("/account/password-change", name="account_password")
     */
    public function index(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher, UserInterface $user): Response
    {

        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Your password has been successfuly changed !');
            $old_pwd = $form->get('old_password')->getData();
            $new_pwd = $form->get('new_password')->getData();
            $isOldPwdValid = $hasher->isPasswordValid($user, $old_pwd);
            if($isOldPwdValid) {

            $password = $hasher->hashPassword($user, $new_pwd);
            $user->setPassword($password);
            $doctrine->flush();

            return $this->redirectToRoute('account');
            }
            
        }


        return $this->renderForm('account/password.html.twig', [
            "form" => $form
        ]);
    }
}
