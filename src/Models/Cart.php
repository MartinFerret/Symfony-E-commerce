<?php

namespace App\Models;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{

    private $session;
    private $pr;

    public function __construct (SessionInterface $session, ProductRepository $pr)
    {
        $this->session = $session;
        $this->pr = $pr;
    }

    public function add ($id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id]))
        {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        return $this->session->set('cart', $cart);
    }

    public function get ()
    {
        return $this->session->get('cart');
    }

    public function remove ()
    {
        return $this->session->remove('cart');
    }

    public function delete ($id)
    {
        $cart = $this->session->get('cart', []);

        unset($cart[$id]);

        return $this->session->set('cart', $cart);
    }

    public function decrease ($id)
    {
        $cart = $this->session->get('cart');

        if($cart[$id] > 1) {
            $cart[$id]--;
        }  else {
            unset($cart[$id]);
        }

        return $this->session->set('cart', $cart);
    }

    public function getFull() {
        $basketInfos = [];

        if($this->get()) {
            foreach ($this->get() as $id => $quantity) {

                $product_object = $this->pr->find($id);

                if (!$product_object) {
                    $this->delete($id);
                    continue;   
                }

                $basketInfos[] = [
                    "product" => $product_object,
                    "quantity" => $quantity
                ];
            }
        }
        return $basketInfos;
    }
}