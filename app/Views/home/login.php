<h1>Connexion</h1>

<?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red;">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </p>
<?php endif; ?>

<form method="POST" action="/login">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Se connecter</button>
</form>
