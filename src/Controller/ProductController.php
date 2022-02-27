<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/our-products", name="our_products")
     */
    public function allProducts(ProductRepository $pr): Response
    {
        return $this->render('product/index.html.twig', [
            "products" => $pr->findAll()
        ]);
    }

    /**
     * @Route("/product/{slug}", name="product")
     */
    public function product(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            "product" => $product
        ]);
    }
}
