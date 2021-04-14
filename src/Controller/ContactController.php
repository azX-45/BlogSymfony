<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
     /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @return Response
     */
    public function index( Request $request, MailerInterface $mailer): Response
    {
        $formContact = $this->createForm(ContactType::class);
        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $email=(new TemplatedEmail())
                ->subject($formContact->get('sujet')->getData())
                ->from(new Address($formContact->get('email')->getData()))
                ->to('julienserodio45@gmail.com')
                ->htmlTemplate('contact/contact_email.html.twig')
                ->context([
                    'name' => $formContact->get('name')->getData(),
                    'message' => $formContact->get('message')->getData(),
                    
                ]);
          
            $this->addFlash("success", "Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.");

            $mailer->send($email);      

            return $this->redirectToRoute('home');
        }
        
        return $this->render('contact/index.html.twig', [
            'formContact' => $formContact->createView()
        ]);
    }
}
