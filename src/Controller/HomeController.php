<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Services\CartServices;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use App\Repository\SliderHomeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $productRepository;
    private $categoryRepository;
    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
        )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index(ProductRepository $productRepository,SliderHomeRepository $sliderHomeRepository): Response
    {
        $isBest = $productRepository->findByisBest(1);
        $isHot = $productRepository->findByisHot(1);
        $isNewArrival = $productRepository->findByisNewArrival(1);
        $products = $productRepository->findAll();

        return $this->render('home/index.html.twig',
        [
            'isBest' => $isBest,
            'isHot' => $isHot,
            'isNewArrival' => $isNewArrival,
            'products' => $products,
            'sliders' => $sliderHomeRepository->findByisDisplay(true)
        ]);
    }


    /**
     * @Route("/product/show/{id}", name="app_product_details", methods={"GET"})
     */
    public function show(Product $product):Response
    {
       $categories = $product->getFkcategory()->getValues();

        if($product){

            return $this->render('category/proddetail.html.twig',[
                'product' => $product,
                 'categories'=> $categories
            ]);
        }
        return $this->redirectToRoute('app_home');
    }

     
}
