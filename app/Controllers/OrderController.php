<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Order;
use Mini\Models\Cart;

final class OrderController extends Controller
{
    /**
     * Affiche toutes les commandes d'un utilisateur connecté
     */
    public function listByUser(): void
    {
        // Vérifie si l'utilisateur est connecté
        if (empty($_SESSION['user'])) {
             header('Location: /login?redirect=orders&message=login_required');
            exit;
        }

        $user_id = $_SESSION['user']['id']; // ID de l'utilisateur connecté
        $orders = Order::getByUserId($user_id);

        $this->render('order/list', [
            'title' => 'Mes commandes',
            'orders' => $orders
        ]);
    }

    /**
     * Affiche les détails d'une commande
     */
   public function show(): void
{
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null; // ⚡ cast en int
    
    if (!$id) {
        http_response_code(400);
        echo json_encode(['error' => 'Le paramètre id est requis.'], JSON_PRETTY_PRINT);
        return;
    }
    
    $order = Order::findByIdWithProducts($id);
    
    $message = null;
    $messageType = null;
    
    if (isset($_GET['success']) && $_GET['success'] === 'created') {
        $message = 'Commande créée avec succès !';
        $messageType = 'success';
    }
    
    if (!$order) {
        $this->render('order/not-found', params: [
            'title' => 'Commande introuvable'
        ]);
        return;
    }
    
    $this->render('order/show', params: [
        'title' => 'Détails de la commande #' . $id,
        'order' => $order,
        'message' => $message,
        'messageType' => $messageType
    ]);
}


    /**
     * Crée une commande à partir du panier de l'utilisateur connecté
     */
    public function create(): void
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        $cartItems = Cart::getByUserId($user_id);
        if (empty($cartItems)) {
            header('Location: /cart?error=empty_cart');
            exit;
        }

        $orderId = Order::createFromCart($user_id);

        if ($orderId) {
            header('Location: /orders/show?id=' . $orderId . '&success=created');
        } else {
            header('Location: /cart?error=create_failed');
        }
    }
}
