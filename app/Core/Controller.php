<?php
// Active le mode strict pour les types
declare(strict_types=1);

namespace Mini\Core;

// Classe de base pour tous les contrôleurs
class Controller
{
    /**
     * Rendre une vue avec le layout
     */
    protected function render(string $view, array $params = []): void
    {
        extract($params); // transforme les clés du tableau en variables
        $viewFile = dirname(__DIR__) . '/Views/' . $view . '.php';
        $layoutFile = dirname(__DIR__) . '/Views/layout.php';

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;
    }

    /**
     * Redirige vers une URL donnée
     */
    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}
