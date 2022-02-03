<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class SkillFixtures extends Fixture
{
    public const SKILLS = [
        'PHP' => [
            'level' => '80',
        ],
        'JavaScript' => [
            'level' => '40',
        ],
        'SQL' => [
            'level' => '60',
        ],
        'Symfony' => [
            'level' => '60',
        ],
        'React' => [
            'level' => '20',
        ],
        'Git' => [
            'level' => '70',
        ],
        'GitHub' => [
            'level' => '70',
        ],
        'CSS' => [
            'level' => '70',
        ],
        'HTML' => [
            'level' => '80',
        ],
        'PhpStorm' => [
            'level' => '60',
        ],
        'Bootstrap' => [
            'level' => '70',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $i = 0;
        foreach (self::SKILLS as $techno => $data) {
            $skill = new Skill();
            $skill->setTechno($techno);
            $skill->setLevel($data['level']);
            $skill->setCreatedAt(new DateTime());
            $skill->setUpdatedAt(new DateTime());
            $manager->persist($skill);
            $this->addReference('skill_' . $i, $skill);
            $i++;
        }
        $manager->flush();
    }
}
