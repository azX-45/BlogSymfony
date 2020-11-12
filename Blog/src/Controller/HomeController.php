<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {

        $post = new Post();
        $post->setTitle('titre 1')
            ->setContent('salut')
            ->setAuthor('Julien')
            ->setCreatedAt(new \DateTime());

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "post" => $post
        ]);
    }
}