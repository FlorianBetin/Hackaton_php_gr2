<?php

namespace App\Controller;

use App\Model\CartManager;

class CartController extends AbstractController
{
    /**
     * Display Landing Page
     */
    public function index(): string
    {


        $cartManager = new CartManager();
        $carts = $cartManager->cartBytarifId($_POST['formule']);
        var_dump($_POST['formule']);

        return $this->twig->render(
            'Cart/cart.html.twig',
            [
                'carts' => $carts
            ]
        );
    }
}
