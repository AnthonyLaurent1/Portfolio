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
    public function index(ManagerRegistry $managerRegistry, ChartBuilderInterface $chartBuilder): Response
    {
        $skills = $managerRegistry->getRepository(Skill::class)->findAll();
        $oneSkillName = [];
        $oneSkillLevel = [];
        foreach ($skills as $skill) {
            $oneSkillName[] = $skill->getTechno();
            $oneSkillLevel[] = $skill->getLevel();
        }
        $chart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);

        $chart->setData([
            'labels' => $oneSkillName,
            'datasets' => [
                [
                    'borderWidth' => 0,
                    'backgroundColor' => [
                        '#FA0707',
                        '#FBE509',
                        '#3ACC0B',
                        '#0B80CC',
                        '#600BCC',
                        '#DA1FE3',
                        '#FFFFFF',
                        '#000000',
                        '#78491A',
                        "#3AEAB2",
                        '#201864'

                    ],
                    'data' =>  $oneSkillLevel,
                ],
            ],
        ]);
        $chart->setOptions([
            'plugins' => [
                'responsive' => true,
                'legend' => [
                    'position' => 'right',
                    'align' => 'center',
                    'labels' => [
                        'padding' => 20,
                        'textAlign' => 'center',
                        'color' => 'white'
                    ]
                ]
            ]
        ]);


        return $this->render('skill/index.html.twig', [
            'chart' => $chart,
        ]);
    }
}
