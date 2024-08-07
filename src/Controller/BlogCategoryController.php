<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\BlogCategory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogCategoryController extends AbstractController
{
    #[Route('/blog/kategorie/{url}', name: 'app_blog_category_show')]
    public function show(BlogCategory $blog_category): Response
    {
        return $this->render('blog/category/show.html.twig', [
            'blog_category' => $blog_category
        ]);
    }
}