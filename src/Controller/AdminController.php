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
    public function newData(ManagerRegistry $managerRegistry, Request $request): Response
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

    /**
     * @Route("/admin/modifier/projet/{project}", name="edit_project")
     */
    public function editProject(ManagerRegistry $managerRegistry, Request $request, Project $project): Response
    {
        $manager = $managerRegistry->getManager();
        $formProject = $this->createForm(ProjectType::class, $project);
        $formProject->handleRequest($request);
        if ($formProject->isSubmitted() && $formProject->isValid()) {
            $manager->flush();
            $this->addFlash('success', 'Votre projet à été modifié');
            return $this->redirectToRoute('project', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin/edit_project.html.twig', [
            'project_form' => $formProject,
        ]);

    }

    /**
     * @Route("/admin/modifier/compétence/{skill}", name="edit_skill")
     */
    public function editSkill(ManagerRegistry $managerRegistry, Request $request, Skill $skill): Response
    {
        $manager = $managerRegistry->getManager();
        $formSkill = $this->createForm(SkillType::class, $skill);
        $formSkill->handleRequest($request);
        if ($formSkill->isSubmitted() && $formSkill->isValid()) {
            $manager->flush();
            $this->addFlash('success', 'Votre compétence à été modifié');
            return $this->redirectToRoute('skill', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin/edit_skill.html.twig', [
            'skill_form' => $formSkill,
        ]);

    }

    /**
     * @Route("/admin/supprimer/projet/{project}", name="remove_project")
     */
    public function removeProject(Project $project, ManagerRegistry $managerRegistry): Response
    {
        $manager = $managerRegistry->getManager();
        $manager->remove($project);
        $manager->flush();
        $this->addFlash('success', 'Votre projet à bien éte supprimé');
        return $this->redirectToRoute('project', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/admin/supprimer/skill/{skill}", name="remove_skill")
     */
    public function removeSkill(Skill $skill, ManagerRegistry $managerRegistry): Response
    {
        $manager = $managerRegistry->getManager();
        $manager->remove($skill);
        $manager->flush();
        $this->addFlash('success', 'Votre compétence à bien éte supprimé');
        return $this->redirectToRoute('skill', [], Response::HTTP_SEE_OTHER);
    }

}
