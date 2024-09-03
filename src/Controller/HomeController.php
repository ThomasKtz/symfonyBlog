<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        
        return $this->render('home/home.html.twig', [
            'hello' => 'Hello word',
            'articles' => $articles
        ]);
    }

    #[Route('/show/{id}', name: 'show')]
    public function show(ArticleRepository $articleRepository, $id): Response
    {
        $article = $articleRepository->find($id);
        
        return $this->render('show/show.html.twig', [
            'article' => $article
        ]);
    }
}
