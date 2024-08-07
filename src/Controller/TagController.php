<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Tag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TagController extends AbstractController
{
    #[Route('/stitek/{url}', name: 'app_tag_show')]
    public function show(Tag $tag): Response
    {
        return $this->render('tag/show.html.twig', [
            'tag' => $tag
        ]);
    }
}