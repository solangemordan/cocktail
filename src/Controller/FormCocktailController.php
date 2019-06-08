<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Form\CocktailsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FormCocktailController extends AbstractController
{
    /**
     * @Route("/form/cocktail", name="form_cocktails")
     * @Route("/update/{id}", name="update")
     */
    public function form(Request $request, Cocktail $cocktail = null)
    {
        if(!$cocktail){
            $cocktail = new Cocktail();
        }

        $form = $this->createForm(CocktailsType::class, $cocktail);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($cocktail);
            $manager->flush();

            return $this->redirectToRoute('accueil');
        }


        return $this->render('form_cocktail/form_cocktails.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
