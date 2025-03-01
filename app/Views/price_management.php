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
                <div class="navbar-nav w-100">
                    <a href="price_management" class="nav-item nav-link active">
                        <i class="fa fa-tag me-2"></i>Manajemen Harga</a>
                </div>
                <div class="navbar-nav w-100">
                    <a href="selling_price" class="nav-item nav-link">
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
                <h2>Analisis Harga Jual</h2>

                <!-- Search input -->
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Produk...">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga Supplier</th>
                            <th>Margin (%)</th>
                            <th>Harga Jual</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="product-name"><?= $product['product_name'] ?></td>
                            <td><?= 'Rp' . number_format($product['price'], 2, ',', '.') ?></td>
                            <td>
                                <input type="number" class="form-control margin-input"
                                    data-id="<?= $product['product_id'] ?>" value="" placeholder="Masukkan Margin (%)">
                            </td>
                            <td id="selling-price-<?= $product['product_id'] ?>">Rp0,00</td>
                            <td>
                                <button class="btn btn-primary calculate-btn"
                                    data-id="<?= $product['product_id'] ?>">Hitung</button>
                                <button class="btn btn-success save-btn"
                                    data-id="<?= $product['product_id'] ?>">Simpan</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <script>
            // Search functionality
            document.getElementById('searchInput').addEventListener('input', function() {
                const searchValue = this.value.toLowerCase();
                const rows = document.querySelectorAll('#productTableBody tr');

                rows.forEach(row => {
                    const productName = row.querySelector('.product-name').textContent
                        .toLowerCase();
                    if (productName.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            </script>

            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

            <!-- Load jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



            <script>
            let timerInterval;
            const loadingAlert = (titleAlert, messageAlert) => Swal.fire({
                title: `${titleAlert}`,
                html: `${messageAlert}`,
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });
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
            $(document).ready(function() {
                // Fungsi untuk menghitung harga jual
                $('.calculate-btn').click(function() {
                    const id = $(this).data('id');
                    const margin = parseFloat($(`.margin-input[data-id='${id}']`).val());
                    const supplierPriceText = $(`.margin-input[data-id='${id}']`).closest('tr')
                        .find(
                            'td:nth-child(2)').text();

                    // Format harga supplier
                    const supplierPrice = parseFloat(supplierPriceText.replace('Rp', '')
                        .replace(/\./g,
                            '').replace(',', '.').trim());

                    if (isNaN(margin) || margin <= 0) {

                        return showAlert("Invalid input",
                            "Silahkan Masukkan margin yang valid!",
                            "warning");
                    }

                    const sellingPrice = supplierPrice + (supplierPrice * margin / 100);
                    const formattedSellingPrice = 'Rp' + sellingPrice.toFixed(2).replace('.',
                            ',')
                        .replace(/\d(?=(\d{3})+,)/g, '$&.');
                    loadingAlert("Loading...",
                        "Sedang menghitung <b></b>, Mohon untuk menunggu!");
                    setTimeout(() => {
                        $(`#selling-price-${id}`).text(formattedSellingPrice);
                    }, 1500);


                });

                // Fungsi untuk menyimpan harga jual
                $('.save-btn').click(function(event) {
                    event
                        .preventDefault(); // Mencegah halaman melakukan refresh setelah klik tombol simpan
                    const id = $(this).data('id');
                    const sellingPriceText = $(`#selling-price-${id}`).text();
                    const sellingPrice = parseFloat(sellingPriceText.replace('Rp', '').replace(
                        /\./g,
                        '').replace(',', '.').trim());

                    if (isNaN(sellingPrice) || sellingPrice <= 0) {
                        return showAlert("Perhatian!",
                            "Hitung harga jual terlebih dahulu sebelum menyimpan!",
                            "warning");
                    }

                    $.ajax({
                        url: '<?= site_url('selling_price/save') ?>',
                        method: 'POST',
                        data: {
                            product_id: id,
                            selling_price: sellingPrice
                        },
                        success: function(response) {
                            showAlert("Berhasil", "Data berhasil tersimpan!",
                                "success",
                                false)
                            // Anda dapat memperbarui harga jual pada halaman tanpa menghapus margin
                            $(`#selling-price-${id}`).text(response
                                .selling_price_formatted);
                            window.location.href =
                                '<?= site_url('selling_price') ?>'; // Sesuaikan URL jika perlu
                        },
                        error: function() {
                            alert('Terjadi kesalahan saat menyimpan data!');
                        }
                    });
                });

                // Fungsi pencarian produk
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
            });
            </script>


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