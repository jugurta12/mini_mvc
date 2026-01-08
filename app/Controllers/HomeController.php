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

    // =====================
    // AUTHENTIFICATION
    // =====================

    public function login(): void
    {
        $this->render('home/login');
    }

    public function authenticate(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (User::authenticate($email, $password)) {
            $this->redirect('/');
        }

        $_SESSION['error'] = 'Email ou mot de passe incorrect';
        $this->redirect('/login');
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect('/login');
    }

    // =====================
    // USERS (si tu les gardes)
    // =====================

    public function users(): void
    {
        $users = User::getAll();
        $this->render('home/users', ['users' => $users]);
    }

    public function showCreateUserForm(): void
    {
        $this->render('home/create-user');
    }

    public function createUser(): void
    {
        // À adapter si besoin
    }
}
