<?php



namespace App\Controller;

class ArticleController extends AbstractController
{
    /**
     * Display Landing Page
     */
    public function index(): string
    {
        return $this->twig->render('Trips/articles.html.twig');
    }
}
