<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Enum\CategoryEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CategoryFixtures extends Fixture
{
    public const REFERENCE_IDENTIFIER = 'category_';

    public function load(ObjectManager $manager): void
    {
        $i = 1;
        foreach (CategoryEnum::cases() as $case) {
            $category = new Category();
            $category->setName($case);

            $manager->persist($category);
            $this->setReference(self::REFERENCE_IDENTIFIER.$i, $category);
            $i++;
        }

        $manager->flush();
    }
}
