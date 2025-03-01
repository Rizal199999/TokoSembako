<?php
namespace App\Controllers; 
use App\Models\PriceManagementModel; 
use App\Models\SellingPriceModel;  

class PriceManagementController extends BaseController { public function index() { if (!session()->get('username')) {
    return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }
    if (session()->get('role') != 'admin') {
    return redirect()->to('/products');
    }
    $priceManagementModel = new PriceManagementModel();
    $data['products'] = $priceManagementModel->getPrices();
    return view('price_management', $data);
    }

    public function save()
    {
    $product_id = $this->request->getPost('product_id');
    $selling_price = $this->request->getPost('selling_price');
    $priceManagementModel = new PriceManagementModel();
    $priceManagementModel->updateSellingPrice($product_id, $selling_price);
    $formattedSellingPrice = 'Rp' . number_format($selling_price, 2, ',', '.');
    return $this->response->setJSON(['status' => 'success', 'selling_price_formatted' => $formattedSellingPrice]);
    }

    public function returnNull($id)
    {
    $priceManagementModel = new PriceManagementModel();
    $priceManagementModel->updateSellingPrice($id, null);
    return $this->response->setJSON(['status' => 'success']);
    }

    public function sellingPrices()
    {
    if (!session()->get('username')) {
    return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }
    $sellingPriceModel = new SellingPriceModel();
    $data['products'] = $sellingPriceModel->getSellingPrices();
    return view('selling_price', $data);
    }

    public function search_query()
    {
    $query = $this->request->getGet('query');
    $priceManagementModel = new PriceManagementModel();
    $results = $priceManagementModel->searchPrices($query);
    return view('partials/selling_price_table', ['products' => $results]);
    }

    public function deletePrice()
    {
    $productId = $this->request->getPost('product_id');
    if (!$productId) {
    return $this->response->setJSON(['success' => false, 'message' => 'ID produk tidak ditemukan']);
    }
    $priceManagementModel = new PriceManagementModel();
    $priceManagementModel->updateSellingPrice($productId, null);
    return $this->response->setJSON(['success' => true]);
    }
    }