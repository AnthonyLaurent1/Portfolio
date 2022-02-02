<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/projet", name="project")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $projects = $managerRegistry->getRepository(Project::class)->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
