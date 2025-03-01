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
                    <a href="products" class="nav-item nav-link">
                        <i class="fa fa-file-alt me-2"></i>Data Produk</a>
                </div>
                <?php if (session()->get('role') == 'admin') { ?>
                <div class="navbar-nav w-100">
                    <a href="price_management" class="nav-item nav-link">
                        <i class="fa fa-tag me-2"></i>Manajemen Harga</a>
                </div>
                <?php } ?>
                <div class="navbar-nav w-100">
                    <a href="selling_price" class="nav-item nav-link active">
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
                <?php include('components/navlist.php'); ?>
            </nav>
            <!-- Navbar End -->
            <div class="container">
                <h2>Daftar Harga Jual</h2>
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Produk...">
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Harga Jual</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($product['updated_at'])) ?></td>
                            <td><?= $product['product_name'] ?></td>
                            <td><?= 'Rp ' . number_format($product['selling_price'], 0, ',', '.') ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm" setId="<?= $product['product_id'] ?>"
                                    onclick="setDelete(this)">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data harga jual tersedia.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- JavaScript Libraries -->
            <script>
            const showAlert = (titleAlert, messageAlert, alertType, confirmBtn = true) => {
                return Swal.fire({
                    title: `${titleAlert}`,
                    icon: `${alertType}`,
                    text: `${messageAlert}`,
                    showConfirmButton: confirmBtn
                });
            }
            </script>

            <script>
            const setDelete = (attrib) => {
                const idData = attrib.getAttribute('setId'); // Mendapatkan ID dari atribut custom

                // Menampilkan SweetAlert2 untuk konfirmasi penghapusan
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data ini akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengonfirmasi penghapusan
                        fetch(`/selling_price/delete/${idData}`, {
                                method: "GET",
                                headers: {
                                    "Content-Type": "application/json" // Tentukan tipe konten sebagai JSON
                                },
                            })
                            .then((response) => {
                                if (!response.ok) {
                                    throw new Error("Network response was not ok");
                                }
                                return response.json(); // Parsing response JSON
                            })
                            .then((data) => {
                                console.log("Success:", data);
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: "Data berhasil dihapus!",
                                    icon: "success"
                                }).then(() => {
                                    // Refresh halaman atau lakukan tindakan lainnya
                                    location.reload();
                                });
                            })
                            .catch((error) => {
                                console.error("Error:", error);
                                Swal.fire({
                                    title: "Gagal!",
                                    text: "Terjadi kesalahan saat menghapus data.",
                                    icon: "error"
                                });
                            });
                    } else {
                        // Jika pengguna membatalkan penghapusan
                        Swal.fire({
                            title: "Dibatalkan",
                            text: "Data Anda aman!",
                            icon: "info"
                        });
                    }
                });
            };
            </script>

            <script>
            document.getElementById('searchInput').addEventListener('input', function() {
                const searchValue = this.value.toLowerCase();
                const rows = document.querySelectorAll('#productTable tr');
                rows.forEach(row => {
                    const productName = row.cells[0].textContent.toLowerCase();
                    if (productName.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            function searchProducts() {
                var query = $('#searchQuery').val();

                $.ajax({
                    url: '<?= site_url('/selling_price/search_query'); ?>', // Endpoint pencarian
                    method: 'GET',
                    data: {
                        query: query // Kirim parameter pencarian
                    },
                    success: function(response) {
                        // Render ulang tabel dengan data hasil pencarian
                        $('#productTable').html(response);
                    },
                    error: function() {
                        showAlert('Error', 'Gagal memuat data, coba lagi nanti!', 'error');
                    }
                });
            }
            </script>



            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js">
            </script>
            <script src="<?php echo base_url('assets/lib/chart/chart.min.js') ?>"> </script>
            <script src=" <?php echo base_url('assets/lib/easing/easing.min.js') ?>">
            </script>
            <script src=" <?php echo base_url() ?>assets/lib/waypoints/waypoints.min.js">
            </script>
            <script src="<?php echo base_url('assets/lib/owlcarousel/owl.carousel.min.js') ?>">
            </script>
            <script src=" <?php echo base_url('assets/lib/tempusdominus/js/moment.min.js') ?>">
            </script>
            <script src=" <?php echo base_url('assets/lib/tempusdominus/js/moment-timezone.min.js') ?>">
            </script>
            <script src=" <?php echo base_url('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') ?>">
            </script>

            <!-- Template Javascript -->
            <script src=" <?php echo base_url('assets/js/main.js') ?>"></script>
</body>

</html>