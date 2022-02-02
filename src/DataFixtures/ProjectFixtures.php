<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJECTS = [
        'WilderEvent' => [
            'description' => "Création d'un site de gestion d'événement et de sondages en simple MVC,
                              utilisation de méthodes agiles, PHP, SQL, JavaScript, Twig, Bootstrap et Git.",
            'category' => 'category_1',
            'url' => 'https://event.gregoire.tech',
            'linkGitHub' => 'https://github.com/WildCodeSchool/bordeaux-p2-202109-damieux'
        ],
        'Fullbus' => [
            'description' => "Compléter les trajets à vide des compagnies d’autocars en offrant aux
                              voyageurs une nouvelle façon de voyager, plus économique et plus responsable.
                              Développé en Symfony, JavaScript, Bootstrap et utilisation de méthodes agiles.",
            'category' => 'category_0',
            'url' => 'https://fullbus.harari.ovh/ ',
            'linkGitHub' => 'https://github.com/WildCodeSchool/bordeaux-202109-php-project3-fullbus'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $i = 0;
        foreach (self::PROJECTS as $name => $data) {
            $project = new Project();
            $project->setName($name);
            $project->setDescription($data['description']);
            $project->setCategory($this->getReference($data['category']));
            $project->setUrl($data['url']);
            $project->setLinkGitHub($data['linkGitHub']);
            $project->setCreatedAt(new DateTime());
            $project->setUpdatedAt(new DateTime());
            $manager->persist($project);
            $this->addReference('project_' . $i, $project);
            $i++;
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
