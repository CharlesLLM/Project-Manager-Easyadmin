<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE_IDENTIFIER = 'project_';
    public const PROJECTS = [
        "POC Symfony" => [
            "description" => "Proof of concept Symfony",
            "link" => "https://github.com/CharlesLLM/Project-Manager-Easyadmin",
            "start_date" => "2024-02-15",
            "end_date" => "2024-03-11",
            "category" => "category_3",
            "technologies" => [
                "technology_0",
                "technology_1",
                "technology_4",
            ],
        ],
        "POC React" => [
            "description" => "Proof of concept React",
            "start_date" => "2024-02-13",
            "category" => "category_3",
            "technologies" => [
                "technology_0",
                "technology_2",
                "technology_5",
            ],
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $i = 1;
        foreach (self::PROJECTS as $key => $value) {
            $project = new Project();
            $project->setName($key)
                ->setDescription($value["description"])
                ->setLink($value["link"] ?? null)
                ->setStartDate(new \DateTime($value["start_date"]))
                ->setEndDate(isset($value["end_date"]) ? new \DateTime($value["end_date"]) : null)
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setCategory($this->getReference($value["category"]));

            foreach ($value["technologies"] as $technology) {
                $project->addTechnology($this->getReference($technology));
            }

            $manager->persist($project);
            $this->setReference(self::REFERENCE_IDENTIFIER.$key, $project);
            $i++;
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            TechnologyFixtures::class,
        ];
    }
}
