<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'products'; // Nama tabel
    protected $primaryKey = 'product_id'; // Primary key
    protected $allowedFields = ['product_name', 'category', 'price', 'unit', 'stock', 'description', 'selling_price']; // Field yang diizinkan

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

    public function searchProducts($query)
    {
        return $this->like('product_name', $query)
            ->findAll();
    }

    public function mergeSort($arr, $type = 'price')
    {
        if (count($arr) <= 1) {
            return $arr;
        }

        $mid = floor(count($arr) / 2);
        $left = array_slice($arr, 0, $mid);
        $right = array_slice($arr, $mid);

        $left = $this->mergeSort($left, $type);
        $right = $this->mergeSort($right, $type);

        return $this->merge($left, $right, $type);
    }

    public function merge($left, $right, $type)
    {
        $result = [];
        $i = $j = 0;

        while ($i < count($left) && $j < count($right)) {
            if ($left[$i][$type] <= $right[$j][$type]) {
                $result[] = $left[$i];
                $i++;
            } else {
                $result[] = $right[$j];
                $j++;
            }
        }

        return array_merge($result, array_slice($left, $i), array_slice($right, $j));
    }

    public function quickSort($arr, $type = 'price')
    {
        if (count($arr) < 2) {
            return $arr;
        }

        $pivot = $arr[0];
        $left = [];
        $right = [];

        for ($i = 1; $i < count($arr); $i++) {
            if ($arr[$i][$type] <= $pivot[$type]) {
                $left[] = $arr[$i];
            } else {
                $right[] = $arr[$i];
            }
        }

        return array_merge($this->quickSort($left, $type), [$pivot], $this->quickSort($right, $type));
    }

    public function filterByPrice($type, $algorithm)
    {
        $products = $this->getAllProductsNotLimit();

        if ($algorithm == 'quick') {
            $sortedProducts = $this->quickSort($products, 'price');
        } else {
            $sortedProducts = $this->mergeSort($products, 'price');
        }

        if ($type == 'low') {
            return $sortedProducts;
        } elseif ($type == 'high') {
            return array_reverse($sortedProducts);
        }
    }

    public function filterByStock($type, $algorithm = 'merge')
    {
        $products = $this->getAllProductsNotLimit();

        if ($algorithm == 'quick') {
            $sortedProducts = $this->quickSort($products, 'stock');
        } else {
            $sortedProducts = $this->mergeSort($products, 'stock');
        }

        if ($type == 'low') {
            return $sortedProducts;
        } elseif ($type == 'high') {
            return array_reverse($sortedProducts);
        }
    }

    public function updateSellingPrice($productId, $sellingPrice)
    {
        return $this->update($productId, ['selling_price' => $sellingPrice]);
    }

    public function benchmarkSortAlgorithms($type)
    {
        $products = $this->getAllProductsNotLimit();

        // Merge Sort
        $sampleData = $products; // Salin dataset
        $startMemory = memory_get_usage();
        $startTime = microtime(true);
        $this->mergeSort($sampleData, $type);
        $mergeSortTime = microtime(true) - $startTime;
        $mergeSortMemory = memory_get_peak_usage(true) / 1024;  // KB

        // Quick Sort
        $sampleData = $products; // Salin dataset
        $startMemory = memory_get_usage();
        $startTime = microtime(true);
        $this->quickSort($sampleData, $type);
        $quickSortTime = microtime(true) - $startTime;
        $quickSortMemory = memory_get_peak_usage(true) / 1024; // KB

        // Menentukan algoritma terbaik berdasarkan kombinasi waktu & memori
        if ($mergeSortTime < $quickSortTime && $mergeSortMemory < $quickSortMemory) {
            $recommended = 'merge';
        } elseif ($quickSortTime < $mergeSortTime && $quickSortMemory < $mergeSortMemory) {
            $recommended = 'quick';
        } elseif ($mergeSortTime < $quickSortTime) {
            $recommended = 'merge';
        } else {
            $recommended = 'quick';
        }

        return [
            'mergeSortTime' => $mergeSortTime,
            'quickSortTime' => $quickSortTime,
            'mergeSortMemory' => $mergeSortMemory,
            'quickSortMemory' => $quickSortMemory,
            'recordCount' => count($products),
            'recommendation' => $recommended
        ];
    }

}