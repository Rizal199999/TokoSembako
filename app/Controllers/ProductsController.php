<?php

namespace App\Controllers;

use App\Models\ProductsModel;

class ProductsController extends BaseController
{
    public function index($curr)
    {
        // Membuat instance model
        $model = new ProductsModel();
        
        $curr_final = $curr * 10;
        // Mengambil semua data produk dari tabel 'products'
        $data = $model->getAllProducts($curr_final);
        $data2 = $model->getAllProductsNotLimit();

        // Mengirim data ke view 'dashboard'
        return view('dashboard', [ 'products' => $data , 'pages' => $data2, 'current' => $curr ]);
    }
}