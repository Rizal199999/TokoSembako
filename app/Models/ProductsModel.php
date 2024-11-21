<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'products'; // Nama tabel
    protected $primaryKey = 'product_id'; // Primary key
    protected $allowedFields = ['product_name', 'category', 'price', 'unit', 'stock', 'description']; // Field yang diizinkan

    public function getAllProducts($offset = 0, $limit = 10)
    {
        return $this->db->table('products')
                        ->limit($limit, $offset)
                        ->get()
                        ->getResultArray();
    }
    
    public function getAllProductsNotLimit()
    {
        return $this->db->table('products')
                        ->get()
                        ->getResultArray();
    }
    
    public function insertProduct($data)
    {
        return $this->insert($data);
    }
    // Pencarian produk berdasarkan query
    public function searchProducts($query)
    {
        return $this->like('product_name', $query)
                    ->orLike('category', $query)
                    ->orLike('description', $query)
                    ->findAll();
    }
}