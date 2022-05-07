<?php

namespace App\Controller\Admin;

use App\Entity\SliderHome;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SliderHomeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SliderHome::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextEditorField::new('description'),
            TextField::new('btnUrl')->hideOnIndex(),
            BooleanField::new('isDisplay'),
            ImageField::new('image')
                        ->setBasePath('images/slider')
                        ->setUploadDir('public/images/slider')
        ];
        
    }
    
}
