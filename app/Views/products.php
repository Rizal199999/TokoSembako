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
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php echo base_url() ?>assets/img/user.jpg" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Bapak Rizal</h6>
                        <span>Admin</span>
                    </div>
                </div>

                <div class="navbar-nav w-100">
                    <a href="index" class="nav-item nav-link ">
                        <i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                </div>
                <div class="navbar-nav w-100">
                    <a href="products" class="nav-item nav-link active">
                        <i class="fa fa-tachometer-alt me-2"></i>Data Produk</a>
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
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php echo base_url() ?>assets/img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Bapak Rizal</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
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
                        <!-- Tombol dan Ikon -->
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-sm btn-success me-2 d-flex align-items-center"
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
                                        <h5 class="modal-title" id="addProductModalLabel">Tambah Data Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <!-- Body Modal -->
                                    <div class="modal-body">
                                        <form id="addProductForm" action="<?= base_url('products/save'); ?>"
                                            method="POST">
                                            <div class="mb-3">
                                                <label for="productName" class="form-label">Nama Produk</label>
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


                        <a href="<?= site_url('/products'); ?>"
                            class="btn btn-sm btn-primary d-flex align-items-center">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                    </div>
                </div>
                <!-- Flash Message Success or Error -->
                <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times; Berhasil cik</span>
                    </button>
                </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times; Gagal cok!</span>
                    </button>
                </div>
                <?php endif; ?>

                <!-- Tabel Produk -->
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
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
                            $no = ($current > 1) ? $current * 10 : $current; 
                            if (!empty($products) && is_array($products)): 
                            ?>
                            <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $product['product_name']; ?></td>
                                <td><?= $product['category']; ?></td>
                                <td><?= $product['stock']; ?></td>
                                <td><?= $product['unit']; ?></td>
                                <td><?= 'Rp' . number_format($product['price'], 0, ',', '.'); ?></td>
                                <td><?= $product['description']; ?></td>
                                <td>
                                    <button id="<?= $product['product_id']; ?>" class="btn btn-sm btn-primary btn-detail" onclick="modal(this.id)">
                                        Detail
                                    </button>
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
                <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="<?= site_url('/products/'.$current - 1);  ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
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
                            <li class="page-item"><a class="page-link" href="<?= site_url('/products/'.$no);  ?>"><?= $no ?></a>
                            </li>
                            <?php } ?>
                            <?php } ?>

                            <li class="page-item">
                                <a class="page-link" href="<?= site_url('/products/'.$current_page + 1);  ?>" aria-label="Next">
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
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
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
                            <input type="text" name="product_name" class="form-control" id="product_name_modal" readonly>
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
                            <textarea class="form-control" name="description" id="description_modal" readonly></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteButton" onclick="deleteProduct()">Delete</button>
                    <button type="button" class="btn btn-primary" id="editButton" onclick="toggleEditMode()">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
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
                    alert('Data produk tidak ditemukan');
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
                alert('Terjadi kesalahan saat mengambil data produk: ' + error.message);
            }
        }

        // Fungsi untuk mengambil data produk
        async function fetchData(productId) {
            const response = await fetch(`/TokoSembako/public/get-data-modals/${productId}`);
            if (!response.ok) {
                throw new Error('Gagal mengambil data');
            }
            return await response.json();
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

                const response = await fetch(`/TokoSembako/public/products/update/${currentProductId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json();

                if (result.status === 'success') {
                    alert(result.message);
                    $('#detailModal').modal('hide'); // Tutup modal
                    location.reload(); // Refresh halaman
                } else {
                    alert('Error: ' + (result.errors || result.message));
                }
            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan: ' + error.message);
            }
        }



        // Fungsi untuk menghapus produk
        async function deleteProduct() {
            try {
                const confirmDelete = confirm('Apakah Anda yakin ingin menghapus produk ini?');
                if (!confirmDelete) return;

                const response = await fetch(`/TokoSembako/public/products/delete/${currentProductId}`, {
                    method: 'DELETE',
                });

                if (!response.ok) {
                    throw new Error('Gagal menghapus produk');
                }

                alert('Produk berhasil dihapus');
                closeModal();
            } catch (error) {
                alert('Terjadi kesalahan: ' + error.message);
            }
        }

    </script>
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

