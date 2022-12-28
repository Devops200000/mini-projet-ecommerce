<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private  AdminUrlGenerator $adminUrlGenerator){

    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();

        $url = $this->adminUrlGenerator
        ->setController(ProductCrudController::class)
        ->generateUrl();
       return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Firstapp');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('E-commerce');
        yield MenuItem::section('Produits');

        yield MenuItem::subMenu('Actions', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Produit', 'fa fa-plus', Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Produits', 'fa fa-eye', Product::class)
        ]);
     
        yield MenuItem::section('Categories');
       yield MenuItem::subMenu('Actions', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Categorie', 'fa fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Categories', 'fa fa-eye', Category::class)
        ]);

    }
}
