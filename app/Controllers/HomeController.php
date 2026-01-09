<?php
declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\User;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->render('home/index');
    }

    // Affiche le formulaire de login
    public function login(): void
    {
        $this->render('home/login');
    }

    // Traite la connexion
   public function authenticate(): void
{
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // récupère l'utilisateur par email
    $user = \Mini\Models\User::findByEmail($email);

    if ($user && !empty($user['password']) && password_verify($password, $user['password'])) {
        // connexion réussie
        $_SESSION['user'] = $user;
        header('Location: /');
        exit;
    } else {
        // email ou mot de passe incorrect
        $_SESSION['error'] = "Email ou mot de passe incorrect";
        header('Location: /login');
        exit;
    }
}


    public function logout(): void
    {
        session_destroy();
        header('Location: /login');
        exit;
    }

    // Liste des utilisateurs
    public function users(): void
    {
        $users = User::getAll();
        $this->render('home/users', ['users' => $users]);
    }

    // Formulaire création utilisateur
    public function showCreateUserForm(): void
    {
        $this->render('home/create-user');
    }

    // Crée un utilisateur
    public function createUser(): void
    {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = new User();
        $user->setNom($nom);
        $user->setEmail($email);
        $user->setPassword($password); // sera hashé dans save()
        $user->save();

        $_SESSION['user_name'] = $nom;
        header('Location: /');
        exit;
    }
}
