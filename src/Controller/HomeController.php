<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();

        return $this->render('home/index.html.twig', [
            'posts' => $posts,
        ]);
    
    }
}
