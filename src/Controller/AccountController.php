<?php

namespace App\Controller;

use App\Repository\AdresseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(AdresseRepository $adresseRepo): Response
    {
        $adresses = $adresseRepo->findAll();
        return $this->render('account/index.html.twig',['adresses' => $adresses]);
    }
}
