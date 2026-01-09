<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? htmlspecialchars($title) : 'App' ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f7f7f7; }
        a { text-decoration: none; }
        button { cursor: pointer; }
    </style>
</head>
<body>

<?php
// Démarre la session si nécessaire
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Récupère les infos de l'utilisateur connecté
$user = $_SESSION['user'] ?? null;
$user_name = $user['nom'] ?? null;
$user_email = $user['email'] ?? null;
$user_id = $user['id'] ?? 1;

// Détermine la page active
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$isHome = ($currentPath === '/');
$isProducts = ($currentPath === '/products' || str_starts_with($currentPath, '/products/show'));
$isProductsCreate = ($currentPath === '/products/create');
$isCart = ($currentPath === '/cart');
$isOrders = str_starts_with($currentPath, '/orders');
?>

<header style="background-color: #343a40; color: white; padding: 15px 0; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <!-- Logo -->
        <h1 style="margin: 0; font-size: 24px;">
            <a href="/" style="color: white;">FOURTOUT</a>
        </h1>

        <!-- Navigation -->
        <nav>
            <ul style="list-style: none; margin: 0; padding: 0; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <li>
                    <a href="/" 
                       style="color: <?= $isHome ? '#ffc107' : 'white' ?>; padding: 8px 15px; border-radius: 4px; transition: background-color 0.3s;"
                       onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'" 
                       onmouseout="this.style.backgroundColor='transparent'">
                        🏠 Accueil
                    </a>
                </li>
                <li>
                    <a href="/products" 
                       style="color: <?= $isProducts ? '#ffc107' : 'white' ?>; padding: 8px 15px; border-radius: 4px; transition: background-color 0.3s;"
                       onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'" 
                       onmouseout="this.style.backgroundColor='transparent'">
                        📦 Produits
                    </a>
                </li>
                <li>
                    <?php if ($user_name): ?>
                        <a href="/login" 
                           style="color:white; padding: 8px 15px; border-radius: 4px; transition: background-color 0.3s;"
                           onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'"
                           onmouseout="this.style.backgroundColor='transparent'">
                            🎖️ Compte
                        </a>
                    <?php else: ?>
                        <a href="/login" 
                           style="color:white; padding: 8px 15px; border-radius: 4px; transition: background-color 0.3s;"
                           onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'"
                           onmouseout="this.style.backgroundColor='transparent'">
                           Connexion
                        </a>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="/cart?user_id=<?= $user_id ?>" 
                       style="color: <?= $isCart ? '#ffc107' : 'white' ?>; padding: 8px 15px; border-radius: 4px; transition: background-color 0.3s; font-weight: <?= $isCart ? 'bold' : 'normal' ?>;"
                       onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'" 
                       onmouseout="this.style.backgroundColor='<?= $isCart ? 'rgba(255,255,255,0.1)' : 'transparent' ?>'">
                        🛒 Panier
                    </a>
                </li>
                <li>
                    <a href="/orders?user_id=<?= $user_id ?>" 
                       style="color: <?= $isOrders ? '#ffc107' : 'white' ?>; padding: 8px 15px; border-radius: 4px; transition: background-color 0.3s; font-weight: <?= $isOrders ? 'bold' : 'normal' ?>;"
                       onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)'" 
                       onmouseout="this.style.backgroundColor='<?= $isOrders ? 'rgba(255,255,255,0.1)' : 'transparent' ?>'">
                        📋 Mes commandes
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <?= $content ?>
</main>

</body>
</html>
