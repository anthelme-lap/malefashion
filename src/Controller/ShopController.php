<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShopController extends AbstractController
{
   /**
     * @Route("/shop", name="app_shop")
     */
    public function shop(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $products = $productRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('shop/index.html.twig',
        [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/shop/product-category/{id} ", name="app_sho")
     */
    public function cate(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response
    {
        $products = $productRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('shop/index.html.twig',
        [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
