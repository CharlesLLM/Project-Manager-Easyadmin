<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE_IDENTIFIER = 'project_';
    public const PROJECTS = [
        'POC Symfony' => [
            'description' => 'Proof of concept Symfony',
            'link' => 'https://github.com/CharlesLLM/Project-Manager-Easyadmin',
            'start_date' => '2024-02-15',
            'end_date' => '2024-03-11',
            'category' => '3',
            'technologies' => [
                '0',
                '1',
                '4',
            ],
            'thumbnail' => 'symfony.png',
        ],
        'POC React' => [
            'description' => 'Proof of concept React',
            'start_date' => '2024-02-13',
            'category' => '3',
            'technologies' => [
                '0',
                '2',
                '5',
            ],
            'thumbnail' => 'maraiste.jpg',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $i = 1;
        foreach (self::PROJECTS as $key => $value) {
            $project = new Project();
            $project->setName($key)
                ->setDescription($value['description'])
                ->setLink($value['link'] ?? null)
                ->setStartDate(new \DateTime($value['start_date']))
                ->setEndDate(isset($value['end_date']) ? new \DateTime($value['end_date']) : null)
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setCategory($this->getReference(CategoryFixtures::REFERENCE_IDENTIFIER.$value['category']));

            $newFilePath = __DIR__.'/../../public/uploads/projects/'.$value['thumbnail'];
            if (!file_exists($newFilePath)) {
                copy(__DIR__.'/Data/'.$value['thumbnail'], $newFilePath);
            }
            $project->setThumbnailName($value['thumbnail']);

            foreach ($value['technologies'] as $technology) {
                $project->addTechnology($this->getReference(TechnologyFixtures::REFERENCE_IDENTIFIER.$technology));
            }

            $manager->persist($project);
            $this->setReference(self::REFERENCE_IDENTIFIER.$key, $project);
            ++$i;
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
