<?php

namespace App\Controller;

use App\Model\ArticleManager;

class ArticleController extends AbstractController
{
    /**
     * Display Landing Page
     */
    public function index($id): string
    {

        $articleManager = new ArticleManager();
        $articles = $articleManager->articleByEpoqueId($id);
        $articlesLength = count($articles);

        return $this->twig->render('Trips/articles.html.twig', [
            'articles' => $articles,
            'articlesLength' => $articlesLength,

        ]);
    }
}
