<?php

namespace App\Controllers;

use App\Models\ProductsModel;

class ProductsController extends BaseController
{
<<<<<<< HEAD
    public function index()
=======
    public function index(){
        $model = new ProductsModel();
        
        $curr_final = 1 * 10;
        // Mengambil semua data produk dari tabel 'products'
        $data = $model->getAllProducts($curr_final);
        $data2 = $model->getAllProductsNotLimit();

        // Mengirim data ke view 'dashboard'
        return view('dashboard', [ 'products' => $data , 'pages' => $data2, 'current' => 1 ]);
    }
    public function indexWithPagination($curr)
>>>>>>> 56c1b5fe577277ff838bcd5371f66202ef293111
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
        // Load ProductsModel (it should already be autoloaded if you use CodeIgniter's default conventions)
        $productsModel = new ProductsModel();
    
        // Data Validation
        $validation =  \Config\Services::validation();
    
        // Validate data
        if (!$this->validate([
            'product_name' => 'required',
            'category' => 'required',
            'stock' => 'required|numeric',
            'unit' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Please fill all required fields correctly.');
        }
    
        // Prepare data for insertion
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'category' => $this->request->getPost('category'),
            'stock' => $this->request->getPost('stock'),
            'unit' => $this->request->getPost('unit'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
        ];
    
        // Try to insert data into the database
        if ($productsModel->insert($data)) {
            return redirect()->to('/products')->with('success', 'Data produk berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data produk.');
        }
    }
    
    public function search_ajax()
    {
        // Ambil query dari request AJAX
        $query = $this->request->getVar('query');
    
        // Memanggil model untuk mencari data berdasarkan query
        $model = new ProductsModel();
        $products = $model->searchProducts($query);
    
        // Menyiapkan output
        $output = '';
        if (!empty($products) && is_array($products)) {
            foreach ($products as $product) {
                // Render baris tabel
                $output .= '<tr>';
                $output .= '<td>' . $product['product_id'] . '</td>';
                $output .= '<td>' . $product['product_name'] . '</td>';
                $output .= '<td>' . $product['category'] . '</td>';
                $output .= '<td>' . $product['stock'] . '</td>';
                $output .= '<td>' . $product['unit'] . '</td>';
                $output .= '<td>' . 'Rp' . number_format($product['price'], 0, ',', '.') . '</td>';
                $output .= '<td>' . $product['description'] . '</td>';
                $output .= '<td>';
                $output .= '<button class="btn btn-sm btn-primary btn-detail"
                                data-id="' . $product['product_id'] . '"
                                data-name="' . $product['product_name'] . '"
                                data-category="' . $product['category'] . '"
                                data-stock="' . $product['stock'] . '"
                                data-unit="' . $product['unit'] . '"
                                data-price="' . $product['price'] . '"
                                data-description="' . $product['description'] . '" 
                                data-bs-toggle="modal"
                                data-bs-target="#productDetailModal_' . $product['product_id'] . '">Detail</button>';
                $output .= '</td>';
                $output .= '</tr>';
    
                // Render modal detail produk
                $output .= '<div class="modal fade" id="productDetailModal_' . $product['product_id'] . '" tabindex="-1" aria-labelledby="productDetailModalLabel_' . $product['product_id'] . '" aria-hidden="true">';
                $output .= '<div class="modal-dialog">';
                $output .= '<div class="modal-content">';
                $output .= '<div class="modal-header">';
                $output .= '<h5 class="modal-title" id="productDetailModalLabel_' . $product['product_id'] . '">Detail Produk</h5>';
                $output .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                $output .= '</div>';
                $output .= '<div class="modal-body">';
                $output .= '<p>Nama Produk: ' . $product['product_name'] . '</p>';
                $output .= '<p>Kategori: ' . $product['category'] . '</p>';
                $output .= '<p>Stok: ' . $product['stock'] . ' ' . $product['unit'] . '</p>';
                $output .= '<p>Harga: Rp' . number_format($product['price'], 0, ',', '.') . '</p>';
                $output .= '<p>Deskripsi: ' . $product['description'] . '</p>';
                $output .= '</div>';
                $output .= '<div class="modal-footer">';
                $output .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }
        } else {
            $output .= '<tr><td colspan="8" class="text-center">Tidak ada data produk yang sesuai.</td></tr>';
        }
    
        // Kembalikan output
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
    public function delete($id)
{
    $model = new \App\Models\ProductsModel();

    // Cek apakah produk dengan ID yang diberikan ada
    $product = $model->find($id);
    if (!$product) {
        return redirect()->to('/products')->with('error', 'Produk tidak ditemukan.');
    }

    // Hapus produk
    if ($model->deleteProduct($id)) {
        return redirect()->to('/products')->with('success', 'Produk berhasil dihapus.');
    } else {
        return redirect()->to('/products')->with('error', 'Gagal menghapus produk.');
    }
}

}