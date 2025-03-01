<?php if (!empty($products)): ?>
<?php foreach ($products as $product): ?>
<tr id="row-<?= $product['product_id'] ?>">
    <td><?= esc($product['product_name']) ?></td>
    <td><?= 'Rp' . number_format($product['price'], 2, ',', '.') ?></td>
    <td><?= 'Rp' . number_format($product['selling_price'], 2, ',', '.') ?></td>
    <td>
        <button class="btn btn-danger btn-sm" data-id="<?= $product['product_id'] ?>"
            onclick="setDelete(this)">Hapus</button>
    </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="4" class="text-center">Tidak ada data ditemukan.</td>
</tr>
<?php endif; ?>