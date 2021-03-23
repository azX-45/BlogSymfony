<?php

namespace App\Controller;

use \App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;




class PostController extends AbstractController
{
  /**
   *
   * @Route("/articles/{slug}", name="show_post")
   */
  public function show(Post $post, Request $request, CommentRepository $commentRepository, EntityManagerInterface $em)
  {
      
    $comment = new Comment();
    
    $form = $this->createForm(CommentType::class, $comment);

    $comment->setCreatedAt(new \DateTime());
    $comment->setPost($post);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em->persist($comment);
      $em->flush();
      $this->denyAccessUnlessGranted('ROLE_USER');

      $this->addFlash("success", "Votre commentaire a bien été validé");
      return $this->redirectToRoute('home');

    }
    $offset = max(0, $request->query->getInt('offset', 0));
    $paginator = $commentRepository->getCommentPaginator($post, $offset);

    return $this->render('home/post.html.twig', [
      'comments' => $paginator,
      'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
      'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
      'post' => $post,
      'form' => $form->createView(),
    ]);
  }
}



