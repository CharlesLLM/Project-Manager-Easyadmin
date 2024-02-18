<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/projets')]
class ProjectController extends AbstractController
{
    public function __construct(private readonly ProjectRepository $projectRepository)
    {
    }

    #[Route(path: '/', name: 'app_project_index')]
    public function index(): Response
    {
        $projects = $this->projectRepository->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route(path: '/{id}', name: 'app_project_view')]
    public function view(Project $project): Response
    {
        if ($project === null) {
            throw $this->createNotFoundException('Projet non trouvé');
        }

        $projects = $this->projectRepository->findAll();

        return $this->render('project/view.html.twig', [
            'projects' => $projects,
            'project' => $project,
        ]);
    }
}
