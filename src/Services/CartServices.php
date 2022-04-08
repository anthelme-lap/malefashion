<?php 

namespace App\Services;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServices {

    public $session;
    public $productRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
    }

    // AJOUTER UN PRODUIT AU PANIER
    public function addcart($id)
    {
        $cart = $this->getCart();
        
        if (isset($cart[$id]))
        {
            $cart[$id]++;
        }
        else
        {
            $cart[$id] = 1;
        }

        $this->update($cart);
    }

    // DIMINUER LA QUANTITE DU PRODUIT
    public function removeProduct($id){

        $cart = $this->getCart();

        if(!empty($cart[$id])){
            if($cart[$id] > 0){
                $cart[$id]--;
            }

            $this->update($cart);
        }
    }
    public function deleteProduct($id){
        $cart = $this->getCart();

        if(!empty($cart[$id])){
            if($cart[$id] > 0){
                unset($cart[$id]);
            }
            $this->update($cart);
        }
    }

    public function getFullCart(){
        $cart = $this->getCart();
        $dataPanier = [];
        
        foreach ($cart as $id => $quantity) {
            $dataPanier[] = [
                'quantity' => $quantity,
                'products' => $this->productRepository->find($id)
            ];
        }

        return $dataPanier;
    }

    // VIDER LE PANIER
    public function removeCart()
    {
        $this->update([]);
    }

    // MODIFIER LA SESSION
    public function update($cart)
     {
         $this->session->set('cart',$cart);
     }

    //  RECUPERER LA SESSION
    public function getCart(){
        return $this->session->get('cart');
     }
 
     
}