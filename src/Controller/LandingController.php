<?php



namespace App\Controller;

class LandingController extends AbstractController
{
    /**
     * Display Landing Page
     */
    public function index(): string
    {
        return $this->twig->render('Landing/landing.html.twig');
    }
}
