<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES = [
        'Service et réservations',
        'Evenementiel',
        'E-commerce',
    ];
    public function load(ObjectManager $manager): void
    {
        $i = 0;
        foreach (self::CATEGORIES as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $this->addReference('category_' . $i, $category);
            $i++;
        }
        $manager->flush();
    }
}
