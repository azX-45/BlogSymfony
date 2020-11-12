<?php

namespace App\DataFixtures;
use\App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $generator = Faker\Factory::create("fr_FR");
        for($i =0 ; $i < 20 ; $i++){
          $user = new User();
          $user->setFirstName($generator->firstName())
            ->setlastName($generator->lastName)
            ->setEmail($generator->email)
            ->setPassword('password');
          $manager->persist($user);       
        }
        $manager->flush();
    }
}
