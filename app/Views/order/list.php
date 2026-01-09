<h1 style="text-align: center; margin-bottom: 30px; color: #333;">Mes commandes</h1>

<?php if (empty($orders)): ?>
    <div style="text-align: center; padding: 60px; background-color: #f8f9fa; border-radius: 8px;">
        <div style="font-size: 64px; margin-bottom: 20px;">📋</div>
        <h3 style="color: #666; margin-bottom: 15px;">Aucune commande</h3>
        <p style="color: #999; font-size: 16px;">Vous n'avez pas encore passé de commande.</p>
        <a href="/products" style="padding: 12px 30px; background-color: #007bff; color: white; text-decoration: none; border-radius: 6px; font-weight: bold; transition: background 0.3s;">
            Voir les produits
        </a>
    </div>
<?php else: ?>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 700px; font-family: Arial, sans-serif;">
            <thead>
                <tr style="background-color: #007bff; color: white; text-align: left;">
                    <th style="padding: 12px;">ID</th>
                    <th style="padding: 12px;">Date</th>
                    <th style="padding: 12px;">Statut</th>
                    <th style="padding: 12px;">Total</th>
                    <th style="padding: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <?php
                    $colors = [
                        'validee' => ['bg' => '#d4edda', 'text' => '#155724', 'label' => '✅ Validée'],
                        'en_attente' => ['bg' => '#fff3cd', 'text' => '#856404', 'label' => '⏳ En attente'],
                        'annulee' => ['bg' => '#f8d7da', 'text' => '#721c24', 'label' => '❌ Annulée']
                    ];
                    $c = $colors[$order['statut']] ?? ['bg' => '#e7f3ff', 'text' => '#0066cc', 'label' => htmlspecialchars($order['statut'])];
                    ?>
                    <tr style="border-bottom: 1px solid #ddd; transition: background 0.2s; cursor: pointer;" 
                        onmouseover="this.style.backgroundColor='#f1f1f1';" 
                        onmouseout="this.style.backgroundColor='white';">
                        <td style="padding: 12px;"><?= htmlspecialchars($order['id']) ?></td>
                        <td style="padding: 12px;"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                        <td style="padding: 12px;">
                            <span style="padding: 5px 12px; border-radius: 20px; background-color: <?= $c['bg'] ?>; color: <?= $c['text'] ?>; font-weight: bold; font-size: 14px;">
                                <?= $c['label'] ?>
                            </span>
                        </td>
                        <td style="padding: 12px; font-weight: bold; color: #007bff;"><?= number_format((float)$order['total'], 2, ',', ' ') ?> €</td>
                        <td style="padding: 12px;">
                            <a href="/orders/show?id=<?= htmlspecialchars($order['id']) ?>" 
                               style="padding: 6px 15px; background-color: #28a745; color: white; text-decoration: none; border-radius: 6px; font-size: 14px; font-weight: bold; transition: background 0.3s;">
                                👁️ Voir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<!-- Styles supplémentaires pour hover et responsive -->
<style>
    table tbody tr:hover {
        background-color: #f1f1f1;
    }
    a:hover {
        background-color: #1c7c31 !important;
    }
</style>
