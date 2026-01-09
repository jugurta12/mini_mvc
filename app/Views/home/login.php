<?php
// login.php
declare(strict_types=1);

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion / Mon compte</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; }
        .container { max-width: 600px; margin: 50px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background-color:#007bff; color:white; border:none; border-radius:4px; cursor:pointer; }
        button:hover { background-color:#0056b3; }
        .message { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .error { background-color:#f8d7da; color:#721c24; }
        .success { background-color:#d4edda; color:#155724; }
        a { color:#007bff; text-decoration:none; }
    </style>
</head>
<body>
<div class="container">
    <h1>Connexion / Mon compte</h1>

    <?php if (!empty($_SESSION['user'])): ?>
        <p>Bonjour, <strong><?= htmlspecialchars($_SESSION['user']['nom']) ?></strong> !</p>
        <p>Email : <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
        <form method="GET" action="/logout">
            <button type="submit">Se déconnecter</button>
        </form>
    <?php else: ?>

        <?php if (!empty($error)): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="/login">
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Mot de passe</label>
            <input type="password" name="password" required>

            <button type="submit">Se connecter</button>

            <p style="margin-top: 15px;">
                Pas encore inscrit ? 
                <a href="/create-user">Créez un compte</a>
            </p>
        </form>

    <?php endif; ?>
</div>
</body>
</html>
