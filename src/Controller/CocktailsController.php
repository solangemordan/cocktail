<?php

namespace App\Controller;


use App\Entity\Cocktail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CocktailsType;

class CocktailsController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */

    public function cocktailsList()
    {

        $repo = $this->getDoctrine()->getRepository(Cocktail::class);

        $cocktails = $repo->findAll();


        return $this->render('cocktails/index.html.twig', [
            'cocktails' => $cocktails,
        ]);
    }

    /**
     * @Route("/cocktail/details/{id}", name="details")
     */

    public function cocktailDetails(Cocktail $cocktail){
        $repo = $this->getDoctrine()->getRepository(Cocktail::class);
        $cocktail =  $repo->find($cocktail);

        dump($cocktail);

        return $this->render('cocktails/cocktail_details.html.twig', [
            'cocktail' => $cocktail
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */

    public function cocktailDelete(Cocktail $cocktail){

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($cocktail);
        $manager->flush();

        return $this->redirectToRoute('accueil');
    }



}
