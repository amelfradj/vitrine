<?php

namespace App\Controller\Admin;

use App\Entity\Tuto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class TutoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tuto::class;
    }

    
    public function configureFields(string $pageName): iterable
{
    $fields = [
        IdField::new('id')->hideOnForm(),

        // Champ pour "name" (relié à "title" dans votre formulaire)
        TextField::new('name', 'Nom')
            ->setFormTypeOptions([
                'attr' => ['maxlength' => 255],
            ])
            ->setRequired(true),

        // Champ pour "slug"
        SlugField::new('slug', 'Slug')
            ->setTargetFieldName('name'),

        // Champ pour l'image
        ImageField::new('image', 'Image')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),

        // Champ pour "title"
        TextField::new('title', 'Titre')
            ->setFormTypeOptions([
                'attr' => ['maxlength' => 255],
            ]),

        // Champ pour "description"
        TextEditorField::new('description', 'Description'),

        // Champ pour "video"
        TextField::new('video', 'Lien de la vidéo')
            ->setFormTypeOptions([
                'attr' => ['maxlength' => 255],
            ]),

        // Champ pour "link"
        TextField::new('link', 'Lien de la page')
            ->setFormTypeOptions([
                'attr' => ['maxlength' => 255],
            ]),
    ];

    return $fields;
}

}
