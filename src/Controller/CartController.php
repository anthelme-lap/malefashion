<?php

namespace App\Controller;

use App\Services\CartServices;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    private $cartServices;

    public function __construct(CartServices $cartServices)
    {
        $this->cartServices = $cartServices;
    }
    
    /**
     * @Route("/cart", name="app_cart")
     */
    public function index(): Response
    {   
        return $this->redirectToRoute('partia');
    }

    /**
     * @Route("/cart/add/{id}", name="app_add_cart")
     */
    public function add($id): Response
    {   
       $this->cartServices->addcart($id);

        return $this->redirectToRoute('app_home');
    }
}
