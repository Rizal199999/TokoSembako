<?php

namespace App\Models;

use CodeIgniter\Model;

class SellingPriceModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $useTimestamps = true;
    protected $dateFormat = 'date';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'selling_price',
    ];

    public function getSellingPrices()
    {
        return $this->where('selling_price IS NOT NULL', null, false)->findAll();
    }
    
    protected function beforeInsertCreated_at(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    public function updateSellingPrice($productId, $sellingPrice)
    {
        if (is_numeric($sellingPrice) && $sellingPrice > 0) {
            return $this->update($productId, ['selling_price' => $sellingPrice]);
        }
        return false;
    }

    public function searchSellingPrices($query, $sortBy = 'product_name', $sortOrder = 'ASC') {
        $data = $this->like('product_name', $query)->orderBy($sortBy, $sortOrder)->findAll();
        return $data;
    }
    
    
    private function mergeSort($data, $sortBy, $sortOrder) {

    }
}    