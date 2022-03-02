<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAddressController extends AbstractController
{
    /**
     * @Route("/account/address", name="account_address")
     */
    public function index(): Response
    {
        return $this->render('account/address.html.twig', [

        ]);
    }

    /**
     * @Route("/account/address/add", name="address_add")
     */
    public function add(Request $request, EntityManagerInterface $doctrine): Response
    {

        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);
     

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $address->setUser($this->getUser());

            $doctrine->persist($address);

            $doctrine->flush();

            return $this->redirectToRoute('account');
        }
        return $this->renderForm('account/address_add.html.twig', [
            "form" => $form
        ]);
    }
}
