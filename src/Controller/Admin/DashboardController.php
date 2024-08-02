<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
            ->setTitle("Administrace stránek - {$pageName}")
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Stránky', 'fas fa-list', Page::class);
    }

}
