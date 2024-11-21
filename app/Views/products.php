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
                                <th scope="col">ID Produk</th>
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
                            <?php if (!empty($products) && is_array($products)): ?>
                            <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['product_id']; ?></td>
                                <td><?= $product['product_name']; ?></td>
                                <td><?= $product['category']; ?></td>
                                <td><?= $product['stock']; ?></td>
                                <td><?= $product['unit']; ?></td>
                                <td><?= 'Rp' . number_format($product['price'], 0, ',', '.'); ?></td>
                                <td><?= $product['description']; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary btn-detail"
                                        data-id="<?= $product['product_id']; ?>"
                                        data-name="<?= $product['product_name']; ?>"
                                        data-category="<?= $product['category']; ?>"
                                        data-stock="<?= $product['stock']; ?>" data-unit="<?= $product['unit']; ?>"
                                        data-price="<?= $product['price']; ?>"
                                        data-description="<?= $product['description']; ?>" data-bs-toggle="modal"
                                        data-bs-target="#productDetailModal_<?= $product['product_id']; ?>">
                                        Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Detail Produk -->
                            <div class="modal fade" id="productDetailModal_<?= $product['product_id']; ?>" tabindex="-1"
                                aria-labelledby="productDetailModalLabel_<?= $product['product_id']; ?>"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Header Modal -->
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="productDetailModalLabel_<?= $product['product_id']; ?>">Detail
                                                Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <!-- Body Modal -->
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="productNameDetail_<?= $product['product_id']; ?>"
                                                    class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control"
                                                    id="productNameDetail_<?= $product['product_id']; ?>"
                                                    value="<?= $product['product_name']; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productCategoryDetail_<?= $product['product_id']; ?>"
                                                    class="form-label">Kategori</label>
                                                <input type="text" class="form-control"
                                                    id="productCategoryDetail_<?= $product['product_id']; ?>"
                                                    value="<?= $product['category']; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="stockDetail_<?= $product['product_id']; ?>"
                                                    class="form-label">Stok</label>
                                                <input type="number" class="form-control"
                                                    id="stockDetail_<?= $product['product_id']; ?>"
                                                    value="<?= $product['stock']; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="unitDetail_<?= $product['product_id']; ?>"
                                                    class="form-label">Unit</label>
                                                <input type="text" class="form-control"
                                                    id="unitDetail_<?= $product['product_id']; ?>"
                                                    value="<?= $product['unit']; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="priceDetail_<?= $product['product_id']; ?>"
                                                    class="form-label">Harga</label>
                                                <input type="number" class="form-control"
                                                    id="priceDetail_<?= $product['product_id']; ?>"
                                                    value="<?= $product['price']; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descriptionDetail_<?= $product['product_id']; ?>"
                                                    class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control"
                                                    id="descriptionDetail_<?= $product['product_id']; ?>"
                                                    value="<?= $product['description']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between align-items-center">
                                            <div>
                                                <button type="button" class="btn btn-warning me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#productUpdateModal_<?= $product['product_id']; ?>"
                                                    onclick="hideModal('productDetailModal_<?= $product['product_id']; ?>')">
                                                    <i class="fas fa-edit"></i> Update
                                                </button>
                                                <button type="button" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                                <i class="fas fa-times"></i> Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>

                <!-- Modal Update Produk -->
                <div class="modal fade" id="productUpdateModal_<?= $product['product_id']; ?>" tabindex="-1"
                    aria-labelledby="productUpdateModalLabel_<?= $product['product_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="productUpdateModalLabel_<?= $product['product_id']; ?>">
                                    Update Produk
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                                <form action="<?= site_url('products/update/' . $product['product_id']); ?>"
                                    method="post">
                                    <div class="mb-3">
                                        <label for="productNameUpdate_<?= $product['product_id']; ?>"
                                            class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control"
                                            id="productNameUpdate_<?= $product['product_id']; ?>" name="product_name"
                                            value="<?= $product['product_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productCategoryUpdate_<?= $product['product_id']; ?>"
                                            class="form-label">Kategori</label>
                                        <input type="text" class="form-control"
                                            id="productCategoryUpdate_<?= $product['product_id']; ?>" name="category"
                                            value="<?= $product['category']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stockUpdate_<?= $product['product_id']; ?>"
                                            class="form-label">Stok</label>
                                        <input type="number" class="form-control"
                                            id="stockUpdate_<?= $product['product_id']; ?>" name="stock"
                                            value="<?= $product['stock']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="unitUpdate_<?= $product['product_id']; ?>"
                                            class="form-label">Unit</label>
                                        <input type="text" class="form-control"
                                            id="unitUpdate_<?= $product['product_id']; ?>" name="unit"
                                            value="<?= $product['unit']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="priceUpdate_<?= $product['product_id']; ?>"
                                            class="form-label">Harga</label>
                                        <input type="number" class="form-control"
                                            id="priceUpdate_<?= $product['product_id']; ?>" name="price"
                                            value="<?= $product['price']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descriptionUpdate_<?= $product['product_id']; ?>"
                                            class="form-label">Deskripsi</label>
                                        <textarea class="form-control"
                                            id="descriptionUpdate_<?= $product['product_id']; ?>" name="description"
                                            rows="3" required><?= $product['description']; ?></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success"
                                            onclick="closeModalAndReloadTable()">
                                            <i class="fas fa-save"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data produk.</td>
                </tr>
                <?php endif; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>





    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        const bootstrapModal = bootstrap.Modal.getInstance(modal);
        if (bootstrapModal) {
            bootstrapModal.hide(); // Menutup modal
        }
    }

    function confirmBackToDetail(detailModalId, updateModalId) {
        // Tampilkan konfirmasi
        if (confirm("Apakah Anda yakin ingin kembali? Perubahan yang belum disimpan akan hilang.")) {
            // Tutup modal update
            const updateModal = document.getElementById(updateModalId);
            const bootstrapUpdateModal = bootstrap.Modal.getInstance(updateModal);
            if (bootstrapUpdateModal) {
                bootstrapUpdateModal.hide();
            }

            // Buka modal detail
            const detailModal = new bootstrap.Modal(document.getElementById(detailModalId));
            detailModal.show();
        }
    }

    function closeModalAndReloadTable() {
        // Menutup semua modal
        const modals = document.querySelectorAll('.modal.show');
        modals.forEach((modal) => {
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });

        // Reload tabel atau halaman
        location.reload(); // Reload halaman
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