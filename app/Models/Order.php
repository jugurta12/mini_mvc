<?php

namespace Mini\Models;

use Mini\Core\Database;
use Mini\Models\Cart;
use Mini\Models\Product;
use PDO;

class Order
{
    private $id;
    private $user_id;
    private $statut;
    private $total;
    private $created_at;
    private $updated_at;

    // =====================
    // Getters / Setters
    // =====================
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getUserId() { return $this->user_id; }
    public function setUserId($user_id) { $this->user_id = $user_id; }
    public function getStatut() { return $this->statut; }
    public function setStatut($statut) { $this->statut = $statut; }
    public function getTotal() { return $this->total; }
    public function setTotal($total) { $this->total = $total; }
    public function getCreatedAt() { return $this->created_at; }
    public function setCreatedAt($created_at) { $this->created_at = $created_at; }
    public function getUpdatedAt() { return $this->updated_at; }
    public function setUpdatedAt($updated_at) { $this->updated_at = $updated_at; }

    // =====================
    // Méthodes CRUD
    // =====================

    public static function getByUserId(int $user_id): array
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM commande WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findByIdWithProducts(int $id): ?array
    {
        $pdo = Database::getPDO();

        // Récupère la commande
        $stmt = $pdo->prepare("SELECT * FROM commande WHERE id = ?");
        $stmt->execute([$id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$order) return null;

        // Récupère les produits de la commande
        $stmt = $pdo->prepare("
            SELECT cp.*, p.nom as product_nom, p.image_url, p.prix
            FROM commande_produit cp
            INNER JOIN produit p ON cp.product_id = p.id
            WHERE cp.commande_id = ?
        ");
        $stmt->execute([$id]);
        $order['products'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $order;
    }

    public static function createFromCart(int $user_id)
    {
        $pdo = Database::getPDO();
        $cartItems = Cart::getByUserId($user_id);
        if (empty($cartItems)) return false;

        $total = Cart::getTotalByUserId($user_id);

        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO commande (user_id, statut, total) VALUES (?, 'validee', ?)");
            $stmt->execute([$user_id, $total]);
            $orderId = $pdo->lastInsertId();

            $stmt = $pdo->prepare("INSERT INTO commande_produit (commande_id, product_id, quantite, prix_unitaire) VALUES (?, ?, ?, ?)");
            foreach ($cartItems as $item) {
                $product = Product::findById($item['id']);
                if ($product) {
                    $stmt->execute([
                        $orderId,
                        $item['id'],
                        $item['quantite'],
                        $product['prix']
                    ]);
                    $newStock = $product['stock'] - $item['quantite'];
                    $pdo->prepare("UPDATE produit SET stock = ? WHERE id = ?")->execute([$newStock, $item['id']]);
                }
            }

            Cart::clearByUserId($user_id);
            $pdo->commit();
            return $orderId;
        } catch (\Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }
}
