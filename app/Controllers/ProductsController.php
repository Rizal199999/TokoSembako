<?php

namespace App\Controllers;

use App\Models\ProductsModel;

class ProductsController extends BaseController
{
    public function index()
    {
        if (!session()->get('username')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $model = new ProductsModel();
        $data['products'] = $model->getAllProductsNotLimit();
        $data['pages'] = $model->getAllProductsNotLimit();
        $data['current'] = 1;

        return view('products', $data);
    }

    public function pagination($curr)
    {
        if (!session()->get('username')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $model = new ProductsModel();
        $curr_final = ($curr == 0) ? 10 : $curr * 10;
        $data['products'] = $model->getAllProductsNotLimit();
        $data['pages'] = $model->getAllProductsNotLimit();
        $data['current'] = $curr;

        return view('products', $data);
    }

    public function add()
    {
        return view('products');
    }

    public function save()
    {
        $productsModel = new ProductsModel();
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'category' => $this->request->getPost('category'),
            'stock' => $this->request->getPost('stock'),
            'unit' => $this->request->getPost('unit'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
        ];

        if ($productsModel->insert($data)) {
            return redirect()->to('/products')->with('success', 'Data produk berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data produk.');
        }
    }

    public function search_ajax()
    {
        $query = $this->request->getVar('query');
        $model = new ProductsModel();

        if (empty($query)) {
            $products = $model->getAllProductsNotLimit();
        } else {
            $products = $model->searchProducts($query);
            $products = $model->mergeSort($products, 'stock');
        }

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
                $output .= '<td><button class="btn btn-sm btn-primary btn-detail" id="detail-' . $product['product_id'] . '" onclick="modal(' . $product['product_id'] . ')">Detail</button></td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr><td colspan="8" class="text-center">Tidak ada data produk yang sesuai.</td></tr>';
        }

        echo $output;
    }

    public function filterByPrice($type, $algorithm = 'merge')
    {
        $model = new ProductsModel();
        $data['products'] = $model->filterByPrice($type, $algorithm);
        $data['pages'] = $model->getAllProductsNotLimit();
        $data['current'] = 1;

        return view('products', $data);
    }

    public function filterByStock($type, $algorithm = 'merge')
    {
        $model = new ProductsModel();
        $data['products'] = $model->filterByStock($type, $algorithm);
        $data['pages'] = $model->getAllProductsNotLimit();
        $data['current'] = 1;

        return view('products', $data);
    }

    public function resetFilters()
    {
        $model = new ProductsModel();
        $data['products'] = $model->getAllProductsNotLimit();
        $data['pages'] = $model->getAllProductsNotLimit();
        $data['current'] = 1;

        return view('products', $data);
    }

    public function getDataById($id)
    {
        $model = new ProductsModel();
        $data_result = $model->find($id);

        if (!$data_result) {
            return $this->response->setJSON(['error' => 'Product not found']);
        }

        return $this->response->setJSON($data_result);
    }

    public function deleteProduct($id)
    {
        $model = new ProductsModel();
        $model->delete($id);

        return $this->response->setJSON(['status' => 'deleted']);
    }

    public function update($id)
    {
        $data = $this->request->getJSON(true);

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

        $model = new ProductsModel();
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui produk']);
        }
    }
    public function sortComparison()
    {
        $model = new ProductsModel();
        $result = $model->benchmarkSortAlgorithms('price');

        return view('sort_comparison', ['result' => $result]);
    }

}