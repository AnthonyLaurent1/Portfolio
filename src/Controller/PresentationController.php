<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationController extends AbstractController
{
    /**
     * @Route("/presentation", name="presentation")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $users = $managerRegistry->getRepository(User::class)->findAll();

        return $this->render('presentation/index.html.twig', [
            'users' => $users,
        ]);
    }
}
