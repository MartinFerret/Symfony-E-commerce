<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search", methods = {"GET", "POST"})
     */
    public function index(Request $request, ProductRepository $pr): Response
    {
        $requete = $request->request->get('search');
        $productByTitle = $pr->findProductByName($requete);

        if (count($productByTitle) === 1) {
            return $this->redirectToRoute('product', ['slug' => $productByTitle[0]->getSlug()]);
        }

        return $this->render('search/index.html.twig', [
            "productByTitle" => $productByTitle,
        ]);
    }
}

