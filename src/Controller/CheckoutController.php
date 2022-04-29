<?php

namespace App\Controller;

use App\Form\CheckoutType;
use App\Services\CartServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CheckoutController extends AbstractController
{
    /**
     * @Route("/checkout", name="app_checkout")
     */
    public function index(CartServices $cartServices, Request $resquest): Response
    {
        $user = $this->getUser();
        $cart = $cartServices->getFullCart();
        // dd($cart);
        if(!$cart){
            return $this->redirectToroute('app_home');
        }
        // si l'utilisateur n'a pas d'adresse redirect sur page new adresse
        if(!$user->getAdresses()->getValues()){
            return $this->redirectToroute('app_adresse_new');
        }


        $form = $this->createForm(CheckoutType::class,null,['user' => $user]);
        $form->handleRequest($resquest);
        
       

        return $this->render('checkout/index.html.twig',[
            'cart' => $cart, 
            'checkout' => $form->createView()
        ]);
    }

    /**
     * @Route("/checkout/confirm", name="app_checkout_confirm")
     */
    public function confirm(CartServices $cartServices, Request $resquest): Response
    {
        $user = $this->getUser();
        $cart = $cartServices->getFullCart();

        // si l'utilisateur n'a pas d'adresse redirect sur page new adresse
        if (!$user->getAdresses()->getValues()){
            return $this->redirectToroute('app_adresse_new');
        }
        if(!$cart){
            return $this->redirectToroute('app_home');
        }

        $form = $this->createForm(CheckoutType::class,null,['user' => $user]);
        $form->handleRequest($resquest);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $adresse = $data['adresse'];
            $moreInformation = $data['moreInformation'];

            return $this->render('checkout/confirm.html.twig',[
                'cart' => $cart, 
                'adresse' => $adresse, 
                'moreInformation' => $moreInformation, 
                'checkout' => $form->createView()
            ]);
        }
        
        return $this->redirectToroute('app_checkout');
        
    }
}
