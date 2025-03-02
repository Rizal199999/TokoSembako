<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Toko Bahan Sembako</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?php echo base_url('assets/img/favicon.ico');?>" rel=" icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo base_url('assets/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel=" stylesheet">
    <link href=" <?php echo base_url('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') ?>" rel="
        stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel=" stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel=" stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- alert Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Toko Sembako</h3>
                </a>
                <?php include('components/profile.php'); ?>
                <div class="navbar-nav w-100">
                    <a href="products" class="nav-item nav-link active">
                        <i class="fa fa-file-alt me-2"></i>Data Produk</a>
                </div>
                <?php if (session()->get('role') == 'admin') { ?>
                <div class="navbar-nav w-100">
                    <a href="<?php echo site_url('/price_management') ?>" class="nav-item nav-link">
                        <i class="fa fa-tag me-2"></i>Manajemen Harga</a>
                </div>
                <?php } ?>
                <div class="navbar-nav w-100">
                    <a href="<?php echo site_url('/selling_price') ?>" class="nav-item nav-link">
                        <i class="fas fa-money-bill-wave me-2"></i>Harga Jual</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <!-- Ikon untuk Grafik -->
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <div class="icon-container" style="display: flex; gap: 20px;">
                        <i class="fas fa-chart-bar text-primary" style="font-size: 24px; cursor: pointer;"
                            title="Lihat Grafik Perbandingan Algoritma" onclick="viewComparisonGraph()"></i>
                    </div>
                </div>
                <?php include('components/navlist.php'); ?>
            </nav>
            <!-- Navbar End -->

            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Data Produk</h6>
                        <!-- Form Pencarian -->
                        <div class="d-flex justify-content-center align-items-center flex-wrap w-100">
                            <input type="text" id="searchQuery" class="form-control me-2" placeholder="Cari Produk..."
                                onkeyup="searchProducts()">
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary d-flex align-items-center" type="button"
                                    id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-filter me-1" style="font-size: 14px;"></i> Filter
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- Submenu Filter Harga -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Filter Harga</a>
                                        <ul class="dropdown-menu nested-menu">
                                            <li>
                                                <a id="fetchDataLowPrice" class="dropdown-item btn">Paling Rendah</a>
                                            </li>
                                            <li><a id="fetchDataHighPrice" class="dropdown-item btn">Paling
                                                    Tinggi</a></li>
                                        </ul>
                                    </li>
                                    <!-- Submenu Filter Stok -->
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Filter Stok</a>
                                        <ul class="dropdown-menu nested-menu">
                                            <li><a class="dropdown-item btn" id="fetchDataLowStock">Paling
                                                    Sedikit</a></li>
                                            <li><a class="dropdown-item btn" id="fetchDataHighStock">Paling
                                                    Banyak</a></li>
                                        </ul>
                                    </li>
                                    <!-- Reset Filter -->
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= site_url('/products'); ?>">Reset
                                            Filter</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Tombol dan Ikon -->
                            <button type="button" class="btn btn-sm btn-success d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#addProductModal">
                                <i class="fas fa-plus me-1"></i> Tambah
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="addProductModal" tabindex="-1"
                            aria-labelledby="addProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Header Modal -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addProductModalLabel">Tambah
                                            Data Produk
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <!-- Body Modal -->
                                    <div class="modal-body">
                                        <form id="addProductForm" action="<?= base_url('products/save'); ?>"
                                            method="POST">
                                            <div class="mb-3">
                                                <label for="productName" class="form-label">Nama
                                                    Produk</label>
                                                <input type="text" class="form-control" id="productName"
                                                    name="product_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productCategory" class="form-label">Kategori</label>
                                                <input type="text" class="form-control" id="productCategory"
                                                    name="category" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="stock" class="form-label">Stok</label>
                                                <input type="number" class="form-control" id="stock" name="stock"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="unit" class="form-label">Unit</label>
                                                <input type="text" class="form-control" id="unit" name="unit" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Harga</label>
                                                <input type="number" class="form-control" id="price" name="price"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control" id="description"
                                                    name="description" required>
                                            </div>
                                            <!-- Footer Modal -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button class="btn btn-primary" form="addProductForm">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php foreach ($products as $product){?>
                    <?php if (isset($_GET['alert']) && $_GET['alert'] == 'high' && $product['stock'] > 500) { ?>
                        <div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> Terdapat barang dengan stok melebihi standar!
                        </div>
                    <?php
                    break; 
                    }
                    ?>
                    <?php if (isset($_GET['alert']) && $_GET['alert'] == 'low' && $product['stock'] < 20) { ?>
                        <div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> Terdapat barang dengan stok terlalu sedikit silahkan lakukan restok ulang!
                        </div>
                    <?php
                    break; 
                    }
                    ?>
                <?php } ?>
                <!-- Tabel Produk -->
                <div class="table-responsive d-flex flex-column-reverse justify-content-lg-center align-items-center">
                    <table class="table text-start align-middle table-bordered table-hover mb-0 p -3">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">No.</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="productTable">

                            <?php
                            $no = ($current > 1) ? $current * 10 : (($current == 1) ? $current : $current+1); 
                            if (!empty($products) && is_array($products)): 
                            ?>
                            <?php foreach ($products as $product): ?>
                            <tr class="<?= ($no == 1 && $product['stock'] > 500 && isset($_GET['alert']) && $_GET['alert'] == 'high' || $no == 1 && $product['stock'] < 20 && isset($_GET['alert']) && $_GET['alert'] == 'low' ) ? 'text-danger' : (( $product['stock'] > 500 && isset($_GET['alert']) && $_GET['alert'] == 'high' || $product['stock'] < 20 && isset($_GET['alert']) && $_GET['alert'] == 'low' ) ? 'text-warning' : 'text-dark'); ?>">
                                <td>
                                    <span class="d-inline">
                                        <?= $no; ?>
                                        <?php if (isset($_GET['alert']) && $_GET['alert'] == 'low' && $product['stock'] < 20 || isset($_GET['alert']) && $_GET['alert'] == 'high' && $product['stock'] > 500) { ?>
                                            <span class="d-inline text-danger"><i class="fas fa-exclamation-circle"></i></span>
                                        <?php } ?>
                                    </span>
                                </td>
                                <td><?= $product['product_name']; ?></td>
                                <td><?= $product['category']; ?></td>
                                <td><?= $product['stock']; ?></td>
                                <td><?= $product['unit']; ?></td>
                                <td><?= 'Rp' . number_format($product['price'], 0, ',', '.'); ?></td>
                                <td><?= $product['description']; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary btn-detail"
                                        data-id="<?= $product['product_id']; ?>"
                                        onclick="openModal(this)">Detail</button>
                                </td>
                            </tr>
                            <?php $no += 1; ?>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data produk.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                        <nav aria-label="Page navigation example" class="mt-3">
                            <ul class="pagination">
                                <?php if ($current > 1) { ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= site_url('products/' . ($current - 1)); ?>"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <?php } ?>
                                <?php if (!empty($pages)) { 
                                $total_pages = count($pages);
                                
                                $max_pages_to_display = 5;
                                $current_page = $current; // Ganti sesuai dengan halaman saat ini

                                $start_page = max(1, $current_page - floor($max_pages_to_display / 2));
                                $end_page = min($start_page + $max_pages_to_display - 1, $total_pages);
                                
                                if ($end_page - $start_page < $max_pages_to_display) {
                                    $start_page = max(1, $end_page - $max_pages_to_display + 1);
                                }
                            ?>
                                <?php for ($no = $start_page; $no <= $end_page; $no++) { ?>
                                <a class="page-link <?= ($current_page == $no) ? 'bg-primary text-white' : (($current_page <= 1 && $no == 1) ? 'bg-primary text-white' : null )?>"
                                    href="<?= site_url('products/'.$no); ?>">
                                    <?php echo $no ?>
                                </a>

                                <?php } ?>
                                <?php } ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= site_url('products/' . $current_page + 1); ?>"
                                        aria-label="Next">

                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </table>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <!-- Modal Structure -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Product Details</h5>
                        <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="productForm">
                            <div class="form-group">
                                <label for="product_name_modal" class="col-form-label">Product Name:</label>
                                <input type="text" name="product_name" class="form-control" id="product_name_modal"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="category_modal" class="col-form-label">Category:</label>
                                <input type="text" name="category" class="form-control" id="category_modal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="price_modal" class="col-form-label">Price:</label>
                                <input type="text" name="price" class="form-control" id="price_modal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="unit_modal" class="col-form-label">Unit:</label>
                                <input type="text" name="unit" class="form-control" id="unit_modal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="stock_modal" class="col-form-label">Stock:</label>
                                <input type="text" name="stock" class="form-control" id="stock_modal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="description_modal" class="col-form-label">Description:</label>
                                <textarea class="form-control" name="description" id="description_modal"
                                    readonly></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="deleteButton"
                            onclick="deleteProduct()">Delete</button>
                        <button type="button" class="btn btn-primary" id="editButton"
                            onclick="toggleEditMode()">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sortModalLabel">Hasil Kalkulasi Perbandingan Algoritma Sorting</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h1 style="text-align: center;">Merge Sort vs Quick Sort</h1>
                        <p><strong>Waktu Merge Sort:</strong> <span id="mergeTime">Loading...</span></p>
                        <p><strong>Waktu Quick Sort:</strong> <span id="quickTime">Loading...</span></p>
                        <p><strong>Memori Merge Sort:</strong> <span id="mergeMemory">Loading...</span></p>
                        <p><strong>Memori Quick Sort:</strong> <span id="quickMemory">Loading...</span></p>
                        <canvas id="comparisonChart" width="400" height="200"></canvas>
                        <b><i><span id="record"></span> records...</i></b>
                    </div>
                    <p class="text-center">Algoritma rekomendasi "<strong><i><span id="recomend"></span></i></strong>", Silahkan pilih :</p>
                    <div class="modal-footer justify-content-center">
                        <a id="btn-merge" href="" class="btn" >Merge Sort</a>
                        <a id="btn-quick" href="" class="btn" >Quick Sort</a>
                    </div>
                </div>
            </div>
        </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("fetchDataLowPrice").addEventListener("click", function() {
                fetch('/sort-comparison/price') // Sesuaikan dengan URL API
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("mergeTime").textContent = data.mergeSortTime.toFixed(6) + " detik";
                        document.getElementById("quickTime").textContent = data.quickSortTime.toFixed(6) + " detik";
                        document.getElementById("mergeMemory").textContent = data.mergeSortMemory.toFixed(2) + " KB";
                        document.getElementById("quickMemory").textContent = data.quickSortMemory.toFixed(2) + " KB";
                        document.getElementById("record").textContent = data.recordCount + " Data";
                        document.getElementById("btn-merge").href = "<?= site_url('/products/filterByPrice/low/merge?alert=low') ?>";
                        document.getElementById("btn-quick").href = "<?= site_url('/products/filterByPrice/low/quick?alert=low') ?>";
                        if (data.recommendation === 'merge') {
                            document.getElementById("recomend").textContent = "Merge Sort";
                            document.getElementById("btn-merge").classList.add("btn-primary");
                            document.getElementById("btn-quick").classList.add("btn-secondary");
                        } else if(data.recommendation === 'quick') {
                            document.getElementById("recomend").textContent = "Quick Sort";
                            document.getElementById("btn-quick").classList.add("btn-primary");
                            document.getElementById("btn-merge").classList.add("btn-secondary");
                        }
                        updateChart(data);
                        let modal = new bootstrap.Modal(document.getElementById("sortModal"));
                        modal.show();
                    })
                    .catch(error => console.error("Error:", error));
            });

            document.getElementById("fetchDataHighPrice").addEventListener("click", function() {
                fetch('/sort-comparison/price') // Sesuaikan dengan URL API
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("mergeTime").textContent = data.mergeSortTime.toFixed(6) + " detik";
                        document.getElementById("quickTime").textContent = data.quickSortTime.toFixed(6) + " detik";
                        document.getElementById("mergeMemory").textContent = data.mergeSortMemory.toFixed(2) + " KB";
                        document.getElementById("quickMemory").textContent = data.quickSortMemory.toFixed(2) + " KB";
                        document.getElementById("record").textContent = data.recordCount + " Data";
                        document.getElementById("btn-merge").href = "<?= site_url('/products/filterByPrice/high/merge?alert=high') ?>";
                        document.getElementById("btn-quick").href = "<?= site_url('/products/filterByPrice/high/quick?alert=high') ?>";
                        if (data.recommendation === 'merge') {
                            document.getElementById("recomend").textContent = "Merge Sort";
                            document.getElementById("btn-merge").classList.add("btn-primary");
                            document.getElementById("btn-quick").classList.add("btn-secondary");
                        } else if(data.recommendation === 'quick') {
                            document.getElementById("recomend").textContent = "Quick Sort";
                            document.getElementById("btn-quick").classList.add("btn-primary");
                            document.getElementById("btn-merge").classList.add("btn-secondary");
                        }
                        updateChart(data);
                        let modal = new bootstrap.Modal(document.getElementById("sortModal"));
                        modal.show();
                    })
                    .catch(error => console.error("Error:", error));
            });

            document.getElementById("fetchDataHighStock").addEventListener("click", function() {
                fetch('/sort-comparison/stock') // Sesuaikan dengan URL API
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("mergeTime").textContent = data.mergeSortTime.toFixed(6) + " detik";
                        document.getElementById("quickTime").textContent = data.quickSortTime.toFixed(6) + " detik";
                        document.getElementById("mergeMemory").textContent = data.mergeSortMemory.toFixed(2) + " KB";
                        document.getElementById("quickMemory").textContent = data.quickSortMemory.toFixed(2) + " KB";
                        document.getElementById("record").textContent = data.recordCount + " Data";
                        document.getElementById("btn-merge").href = "<?= site_url('/products/filterByStock/high/merge?alert=high') ?>";
                        document.getElementById("btn-quick").href = "<?= site_url('/products/filterByStock/high/quick?alert=high') ?>";
                        if (data.recommendation === 'merge') {
                            document.getElementById("recomend").textContent = "Merge Sort";
                            document.getElementById("btn-merge").classList.add("btn-primary");
                            document.getElementById("btn-quick").classList.add("btn-secondary");
                        } else if(data.recommendation === 'quick') {
                            document.getElementById("recomend").textContent = "Quick Sort";
                            document.getElementById("btn-quick").classList.add("btn-primary");
                            document.getElementById("btn-merge").classList.add("btn-secondary");
                        }
                        updateChart(data);
                        let modal = new bootstrap.Modal(document.getElementById("sortModal"));
                        modal.show();
                    })
                    .catch(error => console.error("Error:", error));
            });

            document.getElementById("fetchDataLowStock").addEventListener("click", function() {
                fetch('/sort-comparison/stock') // Sesuaikan dengan URL API
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("mergeTime").textContent = data.mergeSortTime.toFixed(6) + " detik";
                        document.getElementById("quickTime").textContent = data.quickSortTime.toFixed(6) + " detik";
                        document.getElementById("mergeMemory").textContent = data.mergeSortMemory.toFixed(2) + " KB";
                        document.getElementById("quickMemory").textContent = data.quickSortMemory.toFixed(2) + " KB";
                        document.getElementById("record").textContent = data.recordCount + " Data";
                        document.getElementById("btn-merge").href = "<?= site_url('/products/filterByStock/low/merge?alert=low') ?>";
                        document.getElementById("btn-quick").href = "<?= site_url('/products/filterByStock/low/quick?alert=low') ?>";
                        if (data.recommendation === 'merge') {
                            document.getElementById("recomend").textContent = "Merge Sort";
                            document.getElementById("btn-merge").classList.add("btn-primary");
                            document.getElementById("btn-quick").classList.add("btn-secondary");
                        } else if(data.recommendation === 'quick') {
                            document.getElementById("recomend").textContent = "Quick Sort";
                            document.getElementById("btn-quick").classList.add("btn-primary");
                            document.getElementById("btn-merge").classList.add("btn-secondary");
                        }
                        updateChart(data);
                        let modal = new bootstrap.Modal(document.getElementById("sortModal"));
                        modal.show();
                    })
                    .catch(error => console.error("Error:", error));
            });
        });

        function updateChart(data) {
            const ctx = document.getElementById("comparisonChart").getContext("2d");

            if (window.myChart) window.myChart.destroy(); // Hapus chart lama jika ada

            window.myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Merge Sort', 'Quick Sort'],
                    datasets: [{
                        label: 'Waktu Eksekusi (detik)',
                        data: [data.mergeSortTime, data.quickSortTime],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        yAxisID: 'y' // Pakai sumbu kiri
                    }, {
                        label: 'Penggunaan Memori (KB)',
                        data: [data.mergeSortMemory, data.quickSortMemory],
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        yAxisID: 'y1' // Pakai sumbu kanan
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Waktu (detik)'
                            },
                            position: 'left'
                        },
                        y1: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Memori (KB)'
                            },
                            position: 'right',
                            grid: {
                                drawOnChartArea: false // Agar grid tidak bertumpuk
                            }
                        }
                    }
                }
            });
        }

    </script>
        <!-- Modal -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <script>
    function viewComparisonGraph() {
        // Navigasi ke halaman grafik perbandingan algoritma
        window.location.href = "/sortComparison";
    }
    </script>

    <!-- searching function -->
    <script>
    function searchProducts() {
        var query = $('#searchQuery').val();

        $.ajax({
            url: '<?= site_url('/products/search_query'); ?>',
            method: 'GET',
            data: {
                query: query
            },
            success: function(response) {
                // Menampilkan data produk pada tabel
                $('#productTable').html(response);
            }
        });
    }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event handler untuk submenu
        const dropdownToggles = document.querySelectorAll('.dropdown-submenu > .dropdown-item');

        dropdownToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();

                const submenu = this.nextElementSibling;
                if (submenu) {
                    submenu.classList.toggle('show');
                }
            });
        });
        // Filter Harga
        document.querySelectorAll('.dropdown-item[href*="filterByPrice"]').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.getAttribute('href');
                window.location.href = url; // Redirect ke URL sesuai filter harga
            });
        });

        // Filter Stok
        document.querySelectorAll('.dropdown-item[href*="filterByStock"]').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.getAttribute('href');
                window.location.href = url; // Redirect ke URL sesuai filter stok
            });
        });

    });
    </script>
    <script>
    const showAlert = (titleAlert, messageAlert, alertType, confirmBtn = true) => {
        return Swal.fire({
            title: `${titleAlert}`,
            icon: `${alertType}`,
            text: `${messageAlert}`,
            showConfirmButton: confirmBtn
        });
        $('.dropdown-item').on('click', function(event) {
            event.preventDefault();
            var href = $(this).attr('href');
            window.location.href = href;
        });

    }
    </script>
    <script>
    function openModal(button) {
        const productId = button.getAttribute('data-id'); // Ambil ID produk dari atribut data
        modal(productId); // Panggil fungsi modal dengan ID produk
    }
    </script>
    <!-- modal -->
    <script>
    let isEditMode = false; // Untuk melacak mode edit
    let currentProductId = null; // ID produk aktif

    // Fungsi untuk membuka modal dengan data produk
    async function modal(productId) {
        try {
            currentProductId = productId; // Simpan ID produk aktif
            const data = await fetchData(productId);

            if (!data || !data.product_id) {
                showAlert('No Data', 'Data produk tidak di temukan', 'info');
                return;
            }

            // Isi form modal dengan data
            $('#product_name_modal').val(data.product_name);
            $('#category_modal').val(data.category);
            $('#price_modal').val(data.price);
            $('#unit_modal').val(data.unit);
            $('#stock_modal').val(data.stock);
            $('#description_modal').val(data.description);

            // Menampilkan modal
            $('#detailModal').modal('show');
        } catch (error) {
            showAlert('Error',
                `Terjadi kesalahan saat memuat mengambil data produk ${error.message}`, 'error')
        }
    }

    // Fungsi untuk mengambil data produk
    async function fetchData(productId) {
        console.log('Fetching data for product ID:', productId); // Debug ID produk
        const response = await fetch(`/products/getDataById/${productId}`);
        if (!response.ok) {
            console.error('Failed to fetch product data:', response.status);
            throw new Error('Gagal mengambil data produk');
        }
        const data = await response.json();
        console.log('Data fetched:', data); // Debug data yang diterima
        return data;
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        $('#detailModal').modal('hide');
        isEditMode = false; // Reset mode edit
        toggleEditMode(false); // Kembali ke readonly
    }

    // Fungsi untuk mengaktifkan atau menonaktifkan mode edit
    function toggleEditMode(enableEdit = true) {
        isEditMode = enableEdit;

        // Ganti readonly pada input
        $('#product_name_modal').prop('readonly', !isEditMode);
        $('#category_modal').prop('readonly', !isEditMode);
        $('#price_modal').prop('readonly', !isEditMode);
        $('#unit_modal').prop('readonly', !isEditMode);
        $('#stock_modal').prop('readonly', !isEditMode);
        $('#description_modal').prop('readonly', !isEditMode);

        // Ganti tombol Edit menjadi Save
        const editButton = $('#editButton');
        if (isEditMode) {
            editButton.text('Save');
            editButton.attr('onclick', 'saveChanges()');
        } else {
            editButton.text('Edit');
            editButton.attr('onclick', 'toggleEditMode()');
        }
    }

    // Fungsi untuk menyimpan perubahan
    async function saveChanges() {
        try {
            const data = {
                product_name: $('#product_name_modal').val(),
                category: $('#category_modal').val(),
                stock: parseInt($('#stock_modal').val(), 10),
                unit: $('#unit_modal').val(),
                price: parseInt($('#price_modal').val(), 10),
                description: $('#description_modal').val(),
            };

            const response = await fetch(`/products/update/${currentProductId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();

            if (result.status === 'success') {
                showAlert('Berhasil', `${result.message}`, 'success', false);
                $('#detailModal').modal('hide'); // Tutup modal
                location.reload(); // Refresh halaman
            } else {
                showAlert('Error', `${result.errors || result.message}`, 'error')
            }
        } catch (error) {
            console.error(error);
            showAlert('Error', `Terjadi kesalahan :${error.message}`, 'error')
        }
    }



    // Fungsi untuk menghapus produk
    async function deleteProduct() {
        const baseUrl = "<?= base_url() ?>";
        try {
            const confirmDelete = confirm('Apakah Anda yakin ingin menghapus produk ini?');
            if (!confirmDelete) return;

            const response = await fetch(`/products/delete/${currentProductId}`, {
                method: 'DELETE',
            });

            if (!response.ok) {
                throw new Error('Gagal menghapus produk');
            }
            showAlert('Berhasil', 'Produk berhasil dihapus.', 'success', false);
            window.location.href = baseUrl + "/products";
            closeModal();

        } catch (error) {
            showAlert('Error', `Terjadi kesalahan :${error.message}`, 'error');
        }
    }
    </script>
    <!-- Flash Message Success or Error -->
    <?php if (session()->getFlashdata('success')): ?>
    <script>
    showAlert('Selamat Datang', 'Anda Berhasil Login!', 'success');
    </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <script>
    showAlert('Gagal', 'Terjadi kesalahan dalam memuat data!', 'error');
    </script>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/lib/chart/chart.min.js') ?>"> </script>
    <script src=" <?php echo base_url('assets/lib/easing/easing.min.js') ?>">
    </script>
    <script src=" <?php echo base_url() ?>assets/lib/waypoints/waypoints.min.js">
    </script>
    <script src="<?php echo base_url('assets/lib/owlcarousel/owl.carousel.min.js') ?>"></script>
    <script src=" <?php echo base_url('assets/lib/tempusdominus/js/moment.min.js') ?>"></script>
    <script src=" <?php echo base_url('assets/lib/tempusdominus/js/moment-timezone.min.js') ?>">
    </script>
    <script src=" <?php echo base_url('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') ?>">
    </script>

    <!-- Template Javascript -->
    <script src=" <?php echo base_url('assets/js/main.js') ?>"></script>
</body>

</html>