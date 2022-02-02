<?php

namespace App\Controller;

use App\Entity\Skill;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends AbstractController
{
    /**
     * @Route("/competences", name="skill")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $skills = $managerRegistry->getRepository(Skill::class)->findAll();

        return $this->render('skill/index.html.twig', [
            'skills' => $skills,
        ]);
    }
}
