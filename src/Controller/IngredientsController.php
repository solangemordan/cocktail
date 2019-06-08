<?php

namespace App\Controller;

use App\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IngredientsController extends AbstractController
{
    /**
     * @Route("/ingredients", name="ingredients")
     */
    public function ingredientsList()
    {

        $repo = $this->getDoctrine()->getRepository(Ingredient::class);
        $ingredients = $repo->findAll();

        return $this->render('ingredients/ingredients_list.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
}
