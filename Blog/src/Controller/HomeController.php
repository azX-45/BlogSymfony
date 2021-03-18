<?php

namespace App\Controller;

use \App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;




class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PostRepository $ripo)
    {
        $posts = $ripo->findAll();

        return $this->render('home/index.html.twig', [
            'posts' => $posts
        ]);
    }

    



        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
            
            $comment->setCreatedAt(new \DateTime());
            $comment->setPost($post);

            $form->handleRequest($request);   

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($comment);
            $em->flush();
        }

        return $this->render('home/post.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }
}
