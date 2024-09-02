<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Entity\BlogCategory;
use App\Entity\Page;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private EntityManagerInterface $em,
    ){}

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // get last postet page
        $lastPublishedPage = $this->em->getRepository(Page::class)->findBy(['isPublished' => true], ['createdAt' => 'DESC'], 5);

        return $this->render('admin/dashboard.html.twig', [
            'last_published_pages' => $lastPublishedPage,
        ]);

    }

    public function configureDashboard(): Dashboard
    {
        $pageName = $this->getParameter('page_name');

        return Dashboard::new()
            ->setTitle("Administrace<br><small class='text-secondary'>{$pageName}</small>")
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Typy stránek');
        yield MenuItem::linkToCrud('Stránky', 'fa-regular fa-file', Page::class);
        yield MenuItem::linkToCrud('Články', 'fa-regular fa-file-lines', Blog::class);
        yield MenuItem::linkToCrud('Štítky', 'fa-solid fa-tags', Tag::class);
        yield MenuItem::section('Nastavení pro články');
        yield MenuItem::linkToCrud('Kategorie článků', 'fa-solid fa-list', BlogCategory::class);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addAssetMapperEntry('admin');
    }

}
