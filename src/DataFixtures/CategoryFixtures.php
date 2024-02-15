<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CategoryFixtures extends Fixture
{
    public const REFERENCE_IDENTIFIER = 'category_';
    public const CATEGORIES = [
        'Projet personnel',
        'E-Commerce',
        'Application mobile',
        'Veille technologique'
    ];

    public function load(ObjectManager $manager): void
    {
        $i = 1;
        foreach (self::CATEGORIES as $case) {
            $category = new Category();
            $category->setName($case);

            $manager->persist($category);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $category);
            $i++;
        }

        $manager->flush();
    }
}
