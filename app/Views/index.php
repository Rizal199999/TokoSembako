<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Toko Bahan Sembako</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?php echo base_url() ?> assets/img/favicon.ico" rel="icon">

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
                    <a href="index.html" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
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
                        <a href="">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">ID Produk</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($products)): ?>
                                <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= $product['product_id']; ?></td>
                                    <td><?= $product['stock']; ?></td>
                                    <td><?= $product['unit']; ?></td>
                                    <td><?= $product['product_name']; ?></td>
                                    <td><?= $product['category']; ?></td>
                                    <td><?= $product['description']; ?></td>
                                    <td><?= 'Rp' . number_format($product['price'], 0, ',', '.'); ?></td>
                                    <td><a class="btn btn-sm btn-primary" href="#">Detail</a></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data produk.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="<?= site_url('/'.$current - 1);  ?>" aria-label="Previous">
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
                            <li class="page-item"><a class="page-link" href="<?= site_url('/'.$no);  ?>"><?= $no ?></a>
                            </li>
                            <?php } ?>
                            <?php } ?>

                            <li class="page-item">
                                <a class="page-link" href="<?= site_url('/'.$current_page + 1);  ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>



            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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