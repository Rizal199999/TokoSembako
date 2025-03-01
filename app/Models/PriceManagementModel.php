<?php 

namespace App\Models;

use CodeIgniter\Model;

class PriceManagementModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $allowedFields = [
        'price',
        'selling_price',
    ];

    public function updatePrice($productId, $price)
    {
        return $this->update($productId, ['price' => $price]);
    }

    public function updateSellingPrice($productId, $sellingPrice)
    {
        return $this->update($productId, ['selling_price' => $sellingPrice]);
    }
    public function getPrices()
    {
        return $this->findAll();
    }

    public function searchPrices($query)
    {
        return $this->like('product_name', $query)->findAll();
    }
}