<?php

namespace App\Controller;

class EpoqueController extends AbstractController
{
    /**
     * Display Landing Page
     */
    public function index(): string
    {
        return $this->twig->render('Trips/epoque.html.twig');
    }
}
