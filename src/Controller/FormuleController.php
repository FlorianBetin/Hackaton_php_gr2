<?php

namespace App\Controller;

use App\Model\FormuleManager;

class FormuleController extends AbstractController
{
    /**
     * Display Landing Page
     */
    public function index(): string
    {

        $formuleModel = new FormuleManager();
        $formules = $formuleModel->selectAll();
        return $this->twig->render('Trips/formule.html.twig', ['formules' => $formules]);
    }
}
