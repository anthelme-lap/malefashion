<?php 

namespace App\Services;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;
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
        $quantity_cart = 0;
        $subTotal = 0;
        foreach ($cart as $id => $quantity) {
            $product = $this->productRepository->find($id);

            if ($product) {
                $dataPanier['products'][]=[
                    'quantity' => $quantity,
                    'product' => $product
                ];
                $quantity_cart = $quantity + $quantity_cart;
                $subTotal = $subTotal + $quantity * $product->getPrice()/100;
            }else{
                $this->removeProduct($id);
            }
        }
        $dataPanier['data'] =[
            'quantity_cart' => $quantity_cart,
            'subTotal' => $subTotal
        ];

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