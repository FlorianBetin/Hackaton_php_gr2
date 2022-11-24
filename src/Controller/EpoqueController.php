<?php

namespace App\Controller;

use App\Model\EpoqueManager;

class EpoqueController extends AbstractController
{
    /**
     * Display Landing Page
     */
    public function index(): string
    {
        $epoqueManager = new EpoqueManager();
        $epoques = $epoqueManager->selectAll();
        return $this->twig->render('Trips/epoque.html.twig', ['epoques' => $epoques,]);
    }
}
