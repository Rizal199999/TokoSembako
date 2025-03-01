<?php
namespace App\Controllers;

use App\Models\SellingPriceModel;

class SellingPriceController extends BaseController
{
    public function index()
    {
        $sellingPriceModel = new SellingPriceModel();
        $products = $sellingPriceModel->getSellingPrices();
        return view('selling_price', ['products' => $products]);
    }

    public function update_selling_price()
    {
        $sellingPriceModel = new SellingPriceModel();
        $id = $this->request->getPost('product_id');
        $sellingPrice = $this->request->getPost('selling_price');
        $sellingPriceModel->update($id, ['selling_price' => $sellingPrice]);
        return redirect()->to('/selling-price');
    }

    public function search_query() {
        $query = $this->request->getGet('query');
        $sellingPriceModel = new SellingPriceModel();
        $results = $sellingPriceModel->searchSellingPrices($query, 'product_name', 'ASC');
        return view('partials/selling_price_table', ['products' => $results]);
    }
    
    
    public function delete($id)
    {
        $sellingPriceModel = new SellingPriceModel();
        try {
            $sellingPriceModel->deleteSellingPrice($id);
            return redirect()->to('/selling-price')->with('success', 'Harga jual berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->to('/selling-price')->with('error', 'Gagal menghapus harga jual.');
        }
    }
}