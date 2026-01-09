<?php


declare(strict_types=1);
// Démarrage de la session
session_start();

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;
use Mini\Controllers\HomeController;
use Mini\Controllers\ProductController;
use Mini\Controllers\CartController;
use Mini\Controllers\OrderController;

// Table des routes
$routes = [
    // Home
    ['GET', '/', [HomeController::class, 'index']],

    // Auth
    ['GET', '/login', [HomeController::class, 'login']],
    ['POST', '/login', [HomeController::class, 'authenticate']],
    ['GET', '/logout', [HomeController::class, 'logout']],

    // Users (si tu les gardes)
    ['GET', '/users', [HomeController::class, 'users']],
    ['POST', '/users', [HomeController::class, 'createUser']],
    ['GET', '/create-user', [HomeController::class, 'showCreateUserForm']],
    ['POST', '/create-user', [HomeController::class, 'createUser']],

    // Products
    ['GET', '/products', [ProductController::class, 'listProducts']],
    ['GET', '/products/show', [ProductController::class, 'show']],
    ['GET', '/products/create', [ProductController::class, 'showCreateProductForm']],
    ['POST', '/products', [ProductController::class, 'createProduct']],

    // Cart
    ['GET', '/cart', [CartController::class, 'show']],
    ['POST', '/cart/add', [CartController::class, 'add']],
    ['POST', '/cart/add-from-form', [CartController::class, 'addFromForm']],
    ['POST', '/cart/update', [CartController::class, 'update']],
    ['POST', '/cart/remove', [CartController::class, 'remove']],
    ['POST', '/cart/clear', [CartController::class, 'clear']],

    // Orders
    ['GET', '/orders', [OrderController::class, 'listByUser']],
    ['GET', '/orders/validated', [OrderController::class, 'listValidated']],
    ['GET', '/orders/show', [OrderController::class, 'show']],
    ['POST', '/orders/create', [OrderController::class, 'create']],
    ['POST', '/orders/update-status', [OrderController::class, 'updateStatus']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
