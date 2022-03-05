<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
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

    /**
     * @Route("/account/address/edit/{id}", name="address_edit")
     */
    public function edit(Request $request, EntityManagerInterface $doctrine, int $id, AddressRepository $ar): Response
    {

        $address = $ar->find($id); 
     
        if (!$address || $address->getUser() != $this->getUser()) {
            return $this->redirectToRoute('account');
        }

        $form = $this->createForm(AddressType::class, $address);
     
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $doctrine->flush();

            return $this->redirectToRoute('account');
        }
        return $this->renderForm('account/address_add.html.twig', [
            "form" => $form
        ]);
    }

    /**
     * @Route("/account/address/delete/{id}", name="address_delete")
     */
    public function delete(Request $request, EntityManagerInterface $doctrine, int $id, AddressRepository $ar): Response
    {

        $address = $ar->find($id); 
     
        if ($address && $address->getUser() == $this->getUser()) {
            $doctrine->remove($address);
            $doctrine->flush();
        }

        return $this->redirectToRoute('account_address');
    }
}
