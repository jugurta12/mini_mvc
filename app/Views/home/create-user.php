<?php
// create-user.php
declare(strict_types=1);

use Mini\Models\User;
session_start();

$error = '';
$success = '';

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$nom || !$email || !$password) {
        $error = "Tous les champs sont requis";
    } else {
        $user = new User();
        $user->setNom($nom);
        $user->setEmail($email);
        $user->setPassword($password); // save() hash automatiquement
        $user->save();
        $success = "Utilisateur créé avec succès !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un utilisateur</title>
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
    <h2>Ajouter un nouvel utilisateur</h2>

    <?php if ($error): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="message success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="create-user.php">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Entrez le nom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="exemple@email.com" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" placeholder="Entrez le mot de passe" required>

        <button type="submit">Créer l'utilisateur</button>
    </form>

    <p style="margin-top: 15px;">
        <a href="login.php">← Retour à la page de connexion</a>
    </p>
</div>
</body>
</html>
