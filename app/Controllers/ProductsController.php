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


    // AJAX ctrl
    public function getDataById($id)
    {
        $model = new ProductsModel();
        $data_result = $model->find($id); // Pastikan find() mengembalikan data yang benar

        // Cek apakah data ditemukan
        if (!$data_result) {
            return $this->response->setJSON(['error' => 'Product not found']);
        }

        // Pastikan data lengkap dikirimkan
        return $this->response->setJSON($data_result);
    }

    // Untuk menghapus produk
    public function deleteProduct($id)
    {
        $model = new ProductsModel();
        $model->delete($id);
        return $this->response->setJSON(['status' => 'deleted']);
    }

    // ajax ctrl
    


    public function pagination($curr)
    {
        // Membuat instance model
        $model = new ProductsModel();
        
        $curr_final = $curr * 10;
        // Mengambil semua data produk dari tabel 'products'
        $data = $model->getAllProducts($curr_final);
        $data2 = $model->getAllProductsNotLimit();

        // Mengirim data ke view 'dashboard'
        return view('products', [ 'products' => $data , 'pages' => $data2, 'current' => $curr ]);
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
        $no = 0;
        $output = '';
        if ($products) {

            foreach ($products as $product) {
                $no++;
                $output .= '<tr>';
                $output .= '<td>' . $no . '</td>';
                $output .= '<td>' . $product['product_name'] . '</td>';
                $output .= '<td>' . $product['category'] . '</td>';
                $output .= '<td>' . $product['stock'] . '</td>';
                $output .= '<td>' . $product['unit'] . '</td>';
                $output .= '<td>' . 'Rp' . number_format($product['price'], 0, ',', '.') . '</td>';
                $output .= '<td>' . $product['description'] . '</td>';
                $output .= '<td><button class="btn btn-sm btn-primary btn-detail" id="'.$product['product_id'].'" onclick="modal(this.id)">Detail</button></td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr><td colspan="8" class="text-center">Tidak ada data produk yang sesuai.</td></tr>';
        }

        echo $output;
    }

    
    public function update($id)
    {
        // Ambil data dari request (JSON)
        $data = $this->request->getJSON(true); // Konversi ke array asosiatif
    
        // Validasi input
        $validation = $this->validate([
            'product_name' => 'required',
            'category' => 'required',
            'price' => 'required|integer',
            'unit' => 'required',
            'stock' => 'required|integer',
            'description' => 'required',
        ]);
    
        if (!$validation) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors(),
            ]);
        }
    
        // Update data di database
        $model = new ProductsModel();
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui produk']);
        }
    }
    
}