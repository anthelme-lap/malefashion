<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\AttachementType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use phpDocumentor\Reflection\Types\Boolean;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            MoneyField::new('price')->setCurrency('USD'),
            TextField::new('dresssize'),
            IntegerField::new('shoesize'),
            TextField::new('tag')->hideOnIndex(),
            BooleanField::new('isBest'),
            BooleanField::new('isNEwArrival'),
            BooleanField::new('isHot'),
            AssociationField::new('fkcategory')
                        ->autocomplete()
                        // ->setFormTypeOption('by_reference',false)
                        ->setTemplatePath('admin/fkcate.html.twig'),
            TextField::new('imageFile')
                    ->setFormType(VichImageType::class)
                    ->hideOnForm()
                    ->hideOnIndex()
                    ->hideWhenUpdating(),
            ImageField::new('firstimage')
                      ->setBasePath('images/products/first')
                      ->setUploadDir('public/images/products/first'),
            CollectionField::new('attachements')
                    ->setEntryType(AttachementType::class)->onlyOnForms(),
            CollectionField::new('attachements')
                    ->onlyOnDetail()
                    ->setTemplatePath('admin/image.html.twig'),
            
        ];
    }
    

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, 'detail');
    }
}
