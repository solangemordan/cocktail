<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Cocktail;
use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CocktailFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create();

        // création des ingrédients

        $ingTab = [];

        for($k = 1 ; $k<=20 ; $k++ ){

            $ingredient = new Ingredient();
            $ingredient->setNom($faker->word);
            $ingredient->setDescription($faker->word);
            $ingTab[] = $ingredient;
            $manager->persist($ingredient);
        }

        // création des catégories

        for($i = 1 ; $i<=5 ; $i++ ){
            $category = new Category();
            $category->setNom($faker->word);
            $category->setDescription($faker->sentence(3));

            $manager->persist($category);

            // création des cocktails

            for($j = 1 ; $j <= mt_rand(3, 7) ; $j++ ){

                $content = '<p>'.join($faker->paragraphs(3),'</p><p>' ).'</p>';

                $cocktail = new Cocktail();
                $cocktail->setNom($faker->name);
                $cocktail->setDescription($content);
                $cocktail->setPrix($faker->numberBetween(5,22));
                $cocktail->setVolume($faker->numberBetween(0,25));
                $cocktail->setOrigine($faker->sentence(3));
                $cocktail->setImageUrl($faker->imageUrl());
                $cocktail->setCategory($category);

                for ($l = 1 ; $l<= mt_rand(4, 7) ; $l++){
                    $ingIndex = array_rand($ingTab);
                    $cocktail->addIngredient($ingTab[$ingIndex]);
                }

                $manager->persist($cocktail);

            }

        }

        $manager->flush();
    }
}
