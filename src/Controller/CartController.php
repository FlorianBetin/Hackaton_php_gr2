<?php

namespace App\Controller;

class CartController extends AbstractController
{
    /**
     * Display Landing Page
     */
    public function index(): string
    {
        return $this->twig->render('Cart/cart.html.twig');
    }
}
