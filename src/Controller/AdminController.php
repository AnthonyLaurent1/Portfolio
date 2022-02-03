<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Skill;
use App\Form\ProjectType;
use App\Form\SkillType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function addProject(ManagerRegistry $managerRegistry, Request $request): Response
    {
        $manager = $managerRegistry->getManager();
        $project = new Project();
        $formProject = $this->createForm(ProjectType::class, $project);
        $formProject->handleRequest($request);
        if ($formProject->isSubmitted() && $formProject->isValid()) {
            $project->setCreatedAt(new DateTime());
            $project->setUpdatedAt(new DateTime());
            $manager->persist($project);
            $manager->flush();
            $this->addFlash('success', 'Votre projet à bien été ajouté');
            return $this->redirectToRoute('project');
        }
        $skill = new Skill();
        $formSkill= $this->createForm(SkillType::class, $skill);
        $formSkill->handleRequest($request);
        if ($formSkill->isSubmitted() && $formSkill->isValid()) {
            $skill->setCreatedAt(new DateTime());
            $skill->setUpdatedAt(new DateTime());
            $manager->persist($skill);
            $manager->flush();
            $this->addFlash('success', 'Votre compétence à bien été ajouté');
            return $this->redirectToRoute('skill');
        }
        return $this->renderForm('admin/index.html.twig', [
            'project_form' => $formProject,
            'skill_form' => $formSkill,
        ]);
    }

}
