<?php

namespace App\Controller;

use App\Entity\Page;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    #[Route('/{url}', name: 'app_page_show')]
    public function show(Page $page): Response
    {

        return $this->render('page/show.html.twig', [
            'page' => $page,
        ]);
    }
}
