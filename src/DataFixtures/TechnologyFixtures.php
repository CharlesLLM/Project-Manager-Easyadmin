<?php

namespace App\DataFixtures;

use App\Entity\Technology;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class TechnologyFixtures extends Fixture
{
    public const REFERENCE_IDENTIFIER = 'technology_';
    public const TECHNOLOGIES = [
        "HTML/CSS",
        "PHP",
        "JavaScript",
        "Python",
        "Symfony",
        "React",
        "Vue",
        "Angular"
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TECHNOLOGIES as $key => $value) {
            $technology = new Technology();
            $technology->setName($value);

            $manager->persist($technology);
            $this->setReference(self::REFERENCE_IDENTIFIER.$key, $technology);
        }

        $manager->flush();
    }
}
