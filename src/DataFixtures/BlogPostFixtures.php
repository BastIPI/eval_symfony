<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class BlogPostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Créations de catégories
        $cat1 = new Category();
        $cat1->setName("Catégorie 1");
        $manager->persist($cat1);
        $manager->flush();

        $cat2 = new Category();
        $cat2->setName("Catégorie 2");
        $manager->persist($cat2);
        $manager->flush();

        $cat3 = new Category();
        $cat3->setName("Super catégorie");
        $manager->persist($cat3);
        $manager->flush();



        // Création d'objets BlogPost a persister en base de données
        $blogPost = new BlogPost();
        $blogPost->setTitle('Mon premier article');
        $blogPost->createSlug();
        $blogPost->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
        $blogPost->setDate((new \DateTime()));
        $blogPost->setCategory($cat3);
        $blogPost->setFeatured(false);
        $manager->persist($blogPost);
        $manager->flush();
        
        $blogPost = new BlogPost();
        $blogPost->setTitle('Mon second article');
        $blogPost->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
        $blogPost->createSlug();
        $blogPost->setDate((new \DateTime()));
        $blogPost->setCategory($cat2);
        $blogPost->setFeatured(false);
        $manager->persist($blogPost);
        $manager->flush();
        
        $blogPost = new BlogPost();
        $blogPost->setTitle('Mon featured article');
        $blogPost->createSlug();
        $blogPost->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
        $blogPost->setDate((new \DateTime()));
        $blogPost->setCategory($cat1);
        $blogPost->setFeatured(true);
        $manager->persist($blogPost);
        $manager->flush();
    }
}
