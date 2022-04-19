<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Services\CartServices;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
        $dataPanier = $this->cartServices->getFullCart(); 
        return $this->render('cart/index.html.twig',['datapaniers' => $dataPanier]);
    }

    /**
     * @Route("/cart/add/{id}", name="app_add_cart")
     */
    public function add($id): Response
    {   
       $this->cartServices->addcart($id);
       return $this->redirectToRoute('app_home');
    }

     /**
     * @Route("/cart/remove/{id}", name="app_remove_cart")
     */
    public function remove($id): Response
    {   
        $this->cartServices->removeProduct($id);
        return $this->redirectToRoute('app_cart');
    }

     /**
     * @Route("/cart/delete/{id}", name="app_delete_cart")
     */
    public function delete($id): Response
    {   
        $this->cartServices->deleteProduct($id);
        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/cart/vider", name="app_vider_cart")
     */
    public function vider(): Response
    {   
        $this->cartServices->getEmptyCart();
        return $this->redirectToRoute('app_home');
    }
}
