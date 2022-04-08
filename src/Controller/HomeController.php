<?php

namespace App\Controller;

use App\Services\CartServices;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/", name="app_home")
     */
    public function index(ProductRepository $productRepository,CartServices $cartServices): Response
    {
        $isBest = $productRepository->findByisBest(1);
        $isHot = $productRepository->findByisHot(1);
        $isNewArrival = $productRepository->findByisNewArrival(1);
 
        return $this->render('home/index.html.twig',
        [
            'isBest' => $isBest,
            'isHot' => $isHot,
            'isNewArrival' => $isNewArrival
        ]);
    }

    /**
    * @Route("/cart/add/{id}", name="add_cart")
    */
    public function add($id,CartServices $cartServices,SessionInterface $session): response
    {
        
        $cart = $cartServices->addcart($id);
        dd($cart);
        return $this->redirectToRoute('app_home');
    }
     
}
