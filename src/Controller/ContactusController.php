<?php



namespace App\Controller;

class ContactusController extends AbstractController
{
    /**
     * Display Landing Page
     */
    public function index(): string
    {
        return $this->twig->render('Contactus/contact.html.twig');
    }
}
