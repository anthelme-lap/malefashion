<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Services\CartServices;
use App\Repository\AdresseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdresseController extends AbstractController
{

    #[Route('/account/adresse/new', name: 'app_adresse_new', methods:['POST','GET'])]
    public function create(Request $request, AdresseRepository $adresseRepo, CartServices $cartServices): Response
    {
        // je recupère l'utilisateur connecté qui créé son adresse
        $user = $this->getUser();
        $adresse = new Adresse();
        $adresse->setFkuser($user);
        $form = $this->createForm(AdresseType::class,$adresse);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid())
        {   
            $adresseRepo->add($adresse); 

            if ($cartServices->getFullCart())
            {
                return $this->redirectToroute('app_checkout');
            }

            return $this->redirectToroute('app_checkout');
        }


        return $this->render('adresse/index.html.twig',[
            'formAdresse' => $form->createView()
        ]);
    }

    #[Route('/account/adresse/edit/{id}', name:'app_adresse_edit', methods:['POST','GET'])]
    public function edit(CartServices $cartServices, Adresse $adresse,Request $request, AdresseRepository $adresseRepo): Response
    { 
        $form = $this->createForm(AdresseType::class,$adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $adresseRepo->add($adresse);
            // $this->redirectToroute('app_account');
            if ($cartServices->getFullCart())
            {
                return $this->redirectToroute('app_checkout_confirm');
            }

            return $this->redirectToroute('app_checkout_confirm');

        }

        return $this->render('adresse/edit.html.twig',[
            'formAdresseEdit' => $form->createView(),
        ]);
    }

    #[Route('/account/adresse/{id}', name:'app_adresse_delete', methods:['GET'])]
    public function delete(Adresse $adresse,AdresseRepository $adresseRepo): Response
    {
        // Si user non connecté ramène sur acceuil
        if(!$this->getUser()){
            return $this->redirectToRoute('app_home');
        }

        // Supprime adresse ok
        $adresseRepo->remove($adresse);
        return $this->redirectToroute('app_account');
    }
}
