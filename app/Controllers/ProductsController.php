<?php

namespace App\Controllers;

use App\Models\ProductsModel;

class ProductsController extends BaseController
{
    public function index()
    {
        $model = new ProductsModel();
        $curr_final = 0 * 10;

        // Mengambil data produk dengan limit dan tanpa limit
        $data = $model->getAllProducts($curr_final);
        $data2 = $model->getAllProductsNotLimit();

        // Mengirim data ke view 'dashboard'
        return view('products', [
            'products' => $data,
            'pages' => $data2,
            'current' => 1
        ]);
    }


    public function indexWithPagination($curr)
    {
        $model = new ProductsModel();
        $curr_final = $curr * 10;

        // Mengambil data produk dengan limit dan tanpa limit
        $data = $model->getAllProducts($curr_final);

        if (empty($data)) {
            return redirect()->to('/products')->with('error', 'Tidak ada data produk.');
        }

        return view('products', ['products' => $data]);
    }

    public function add()
    {
        return view('products');
    }

    public function save()
    {
        $productsModel = new ProductsModel();

        // Validasi data
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'category' => $this->request->getPost('category'),
            'stock' => $this->request->getPost('stock'),
            'unit' => $this->request->getPost('unit'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
        ];

        // Simpan data ke database
        if ($productsModel->insert($data)) {
            return redirect()->to('/')->with('success', 'Data produk berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data produk.');
        }
    }
    public function search_ajax()
    {
        // Ambil query dari request Ajax
        $query = $this->request->getVar('query');

        // Memanggil model untuk mencari data berdasarkan query
        $model = new ProductsModel();
        $products = $model->searchProducts($query);

        // Menampilkan data dalam format tabel
        $output = '';
        if ($products) {
            foreach ($products as $product) {
                $output .= '<tr>';
                $output .= '<td>' . $product['product_id'] . '</td>';
                $output .= '<td>' . $product['stock'] . '</td>';
                $output .= '<td>' . $product['unit'] . '</td>';
                $output .= '<td>' . $product['product_name'] . '</td>';
                $output .= '<td>' . $product['category'] . '</td>';
                $output .= '<td>' . $product['description'] . '</td>';
                $output .= '<td>' . 'Rp' . number_format($product['price'], 0, ',', '.') . '</td>';
                $output .= '<td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr><td colspan="8" class="text-center">Tidak ada data produk yang sesuai.</td></tr>';
        }

        echo $output;
    }
    public function update($id)
    {
        // Validasi input
        $validation = $this->validate([
            'product_name' => 'required',
            'category' => 'required',
            'stock' => 'required|integer',
            'unit' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'category' => $this->request->getPost('category'),
            'stock' => $this->request->getPost('stock'),
            'unit' => $this->request->getPost('unit'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
        ];

        $model = new ProductsModel();
        $model->update($id, $data);

        // Redirect ke halaman produk
        return redirect()->to('/products')->with('success', 'Produk berhasil diupdate');
    }
}