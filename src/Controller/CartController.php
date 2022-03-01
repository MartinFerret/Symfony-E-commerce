<?php

namespace App\Controller;

use App\Models\Cart;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{


    /**
     * @Route("/my-cart", name="cart")
     */
    public function index(Cart $cart, ProductRepository $pr): Response
    {


        return $this->render('cart/index.html.twig', [
            "cart" => $cart->getFull()
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id);
        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/remove", name="cart_remove")
     */
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        return $this->redirectToRoute('products');
    }

    /**
     * @Route("/cart/delete/{id}", name="cart_delete_item")
     */
    public function delete(Cart $cart, int $id): Response
    {
        $cart->delete($id);
        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/decrease/{id}", name="cart_decrease_item")
     */
    public function decrease(Cart $cart, int $id): Response
    {
        $cart->decrease($id);
        return $this->redirectToRoute('cart');
    }
}
