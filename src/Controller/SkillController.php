<?php

namespace App\Controller;

use App\Entity\Skill;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class SkillController extends AbstractController
{
    /**
     * @Route("/competences", name="skill")
     */
    public function index(ChartBuilderInterface $chartBuilder, ManagerRegistry $managerRegistry): Response
    {
        $skills = $managerRegistry->getRepository(Skill::class)->findAll();


        $chart = $chartBuilder->createChart(Chart::TYPE_POLAR_AREA);
        $chart->setData([
            'labels' => [],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 20],
                ],
            ],
        ]);


        return $this->render('skill/index.html.twig', [
            'chart' => $chart,
        ]);
    }
}
