<?php

namespace App\DataFixtures;
use\App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class AppFixtures extends Fixture
{   
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
      $this->encoder =$encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $generator = Faker\Factory::create("fr_FR");
        for($i =0 ; $i < 20 ; $i++){
          $user = new User();
          $password =$this->encoder->encodePassword($user , 'password');
          $user->setFirstName($generator->firstName())
            ->setlastName($generator->lastName)
            ->setEmail($generator->email)
            ->setPassword($password);
          $manager->persist($user);       
        }
        $manager->flush();
    }
}
