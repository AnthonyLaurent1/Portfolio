<?php

namespace App\Controller;

use App\Entity\ContactUs;
use App\Entity\User;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(ManagerRegistry $managerRegistry, Request $request, MailerInterface $mailer): Response
    {
        $manager = $managerRegistry->getManager();
        $contactUs = new ContactUs();
        $form = $this->createForm(ContactType::class, $contactUs);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($contactUs);
            $manager->flush();
            $email = (new Email())
                ->from($contactUs->getEmail())
                ->to('anthonylrtpro@gmail.com')
                ->subject($contactUs->getFirstname() . ' vous à envoyer un message')
                ->text($contactUs->getMessage());
            $mailer->send($email);
            $this->addFlash('success', 'Votre message à bien été envoyé');
            return $this->redirectToRoute('contact');
        }
        $users = $managerRegistry->getRepository(User::class)->findAll();
        return $this->renderForm('contact/index.html.twig', [
            'form' => $form,
            'users' => $users,
        ]);
    }
}
