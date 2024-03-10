<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'project.name'),
            TextEditorField::new('description', 'project.description'),
            AssociationField::new('category', 'project.category'),
            AssociationField::new('technologies', 'project.technologies'),
            DateField::new('startDate', 'project.start_date'),
            DateField::new('endDate', 'project.end_date'),
            ImageField::new('thumbnailName', 'project.thumbnail')
                ->setUploadDir('public/uploads/projects')
                ->setUploadedFileNamePattern('[slug]-[uuid].[extension]')
                ->setBasePath('uploads/projects')
        ];
    }
}
