<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'products'; // Nama tabel
    protected $primaryKey = 'product_id'; // Primary key
    protected $allowedFields = ['product_name', 'category', 'price', 'unit', 'stock', 'description']; // Field yang diizinkan

    public function getAllProducts($curr)
    {
        // Mengambil semua data produk dari tabel 'products'
        return $this->findAll(10, $curr);
    }

    public function getAllProductsNotLimit()
    {
        return $this->findAll();
    }
}