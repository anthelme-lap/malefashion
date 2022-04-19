<?php 

namespace App\Services;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServices {

    private $session;
    private $productRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }

    // AJOUTER UN PRODUIT AU PANIER
    public function addcart($id){
        $cart = $this->getCart();
        if (isset($cart[$id])){
            $cart[$id]++;
        }else{
            $cart[$id] = 1;
        }
        $this->update($cart);
    }

    // DIMINUER LA QUANTITE DU PRODUIT
    public function removeProduct($id){

        $cart = $this->getCart();
        if(isset($cart[$id])){
            if($cart[$id] > 1){
                $cart[$id]--;
            }else{
                unset($cart[$id]);
            }
            $this->update($cart);
        }
    }

    // SUPPRIMER COMPLETEMENT LE PRODUIT DU PANIER
    public function deleteProduct($id){
        $cart = $this->getCart();

        if(isset($cart[$id])){
            if($cart[$id] > 0){
                unset($cart[$id]);
            }
            $this->update($cart);
        }
    }

    // RECUPERER TOUT LE PANIER
    public function getFullCart(){
        $cart = $this->getCart();
        $dataPanier = [];
        
        foreach ($cart as $id => $quantity) {
            $product = $this->productRepository->find($id);
            if ($product) {
                $dataPanier[]=[
                    'quantity' => $quantity,
                    'product' => $product
                ];
            }else{
                $this->removeProduct($id);
            }
        }

        return $dataPanier;
    }

    // MODIFIER LA SESSION
    public function update($cart)
     {
         $this->session->set('cart',$cart);
         $this->session->set('cartData',$this->getFullCart());
     }

    //  RECUPERER LA SESSION
    public function getCart(){
        return $this->session->get('cart',[]);
     }


     public function getEmptyCart(){
         return $this->update([]);
     }
 
     
}