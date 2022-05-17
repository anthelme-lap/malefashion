<?php 

namespace App\Services;

use App\Entity\Cart;
use App\Entity\CartDetail;
use DateTimeImmutable;
use PhpParser\Node\Expr\Cast\Double;
use Doctrine\ORM\EntityManagerInterface;

class OrderServices {

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function createOrder($cart)
    {

    }

    public function saveOrder($data, $user)
    {
        $cart = new Cart();

        $reference = $this->generateUuid();
        $adresse = $data['checkout']['adresse'];
        $moreInformation = $data['checkout']['moreInformation'];

        $cart->setReference($reference)
             ->setFullname($adresse->getFullname())
             ->setAdressdelivery($adresse)
             ->setMoreinformation($moreInformation)
             ->setQuantity($data['data']['quantity_cart'])
             ->setSubTotal($data['data']['subTotal'])
             ->setFkuser($user)
             ->setCreatedAt(new DateTimeImmutable());
             $this->manager->persist($cart);

             $cart_detail_array = [];

             foreach ($data['products'] as $products) {
                $cartDetail = new CartDetail();
                $subTotal = $products['quantity'] * $products['product']->getPrice();

                $cartDetail->setCarts($cart)
                           ->setProductName($products['product']->getName())
                           ->setProductPrice($products['product']->getPrice())
                           ->setQuantity($products['quantity'])
                           ->setSubTotal($subTotal);
                $this->manager->persist($cartDetail);
                $cart_detail_array[] = $cartDetail;

             }
             $this->manager->flush();

             return $cart_detail_array;


    }

    // function pour generer une reference
    public function generateUuid()
    {
        mt_srand((double)microtime()*100000);

        $charid = strtoupper(md5(uniqid(rand(), true)));

        $hypen = chr(45);

        $uuid = ""

        .substr($charid, 0, 8).$hypen
        // .substr($charid, 8, 4).$hypen
        // .substr($charid, 12, 4).$hypen
        // .substr($charid, 16, 4).$hypen
        .substr($charid, 20, 12).$hypen;

        return $uuid;
    }
}