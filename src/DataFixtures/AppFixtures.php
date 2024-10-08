<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PhpParser\Node\Stmt\Catch_;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        // $product = new Product();
        // $manager->persist($product);

        $users = [];

        for($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setUsername($faker->name);
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setPassword($faker->password());
            $user->setEmail($faker->email);
            $user->setCreatedAt(new \DateTime());
            $manager->persist($user);
            $users[] = $user;  
        }

        $categories = [];

        for($i = 0; $i < 50; $i++) {
            $category = new Category();
            $category->setTitle($faker->title());
            $category->setDescription($faker->text(250));
            $category->setImage($faker->imageUrl());
            $manager->persist($category);
            $categories[] = $category;  
        }

        for($i = 0; $i < 100; $i++) {
            $article = new Article();
            $article->setTitle($faker->text(20));
            $article->setContent($faker->text(2000));
            $article->setImage($faker->imageUrl());
            $article->setCreatedAt(new \DateTime());
            $article->addCategory($categories[$faker->numberBetween(0,14)]);
            $article->setUser($users[$faker->numberBetween(0,49)]);
            $manager->persist($article); 
        }

        $manager->flush();
    }
    
}
