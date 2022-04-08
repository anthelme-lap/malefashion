<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $isBest = $productRepository->findByisBest(1);
        $isHot = $productRepository->findByisHot(1);
        $isNewArrival = $productRepository->findByisNewArrival(1);
        // dd($isNewArrival);
        return $this->render('home/index.html.twig',
        [
            'isBest' => $isBest,
            'isHot' => $isHot,
            'isNewArrival' => $isNewArrival
        ]);
    }
}
