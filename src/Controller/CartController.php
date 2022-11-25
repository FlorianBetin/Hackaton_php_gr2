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
        if ($_POST) {
            $carts = $cartManager->cartBytarifId($_POST['formule']);

            return $this->twig->render(
                'Cart/cart.html.twig',
                [
                    'carts' => $carts
                ]
            );
        } else {
            return $this->twig->render(
                'Cart/cart.html.twig'
            );
        }
    }
}
