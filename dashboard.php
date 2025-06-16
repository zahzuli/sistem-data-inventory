<?php
require 'koneksi.php';
require 'cek.php';



$query = "SELECT * FROM stock ORDER BY namabarang ASC";
$result = mysqli_query($conn, $query);


// mengambil data barang
$brg_msk = mysqli_query($conn, "SELECT * FROM masuk");
$brg_klr = mysqli_query($conn, "SELECT * FROM keluar");
$jml_brg = mysqli_query($conn, "SELECT * FROM stock");
 
// menghitung data barang
$jumlah_brg = mysqli_num_rows($jml_brg);
$jumlah_msk = mysqli_num_rows($brg_msk);
$jumlah_klr = mysqli_num_rows($brg_klr);

?>

<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: contain;
    }

    .zoomable {
        transition: transform 0.3s ease;
        /* Menambahkan transisi pada gambar */
    }

    .zoomable:hover {
        transform: scale(1.2);
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PACKMAN - Daftar Barang</title>
    <!-- <link href='assets/img/madya-logo.ico' rel='icon' type='image/x-icon' /> -->
    <link href='di2a8ot-b32e5a09-935a-4449-84c4-e9025df4658c.gif' rel='icon' type='gif' />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/b79720072c.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="dsh_barang.php"><img src="PACKMAN_unscreen.gif" alt="logo"
                width="100%"></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        
        <div class="d-flex justify-content-end" style="font-size: 18px; width: 100%;">
            <div id="waktu" class="text-white mr-4" style="font-family: 'Century Gothic', sans-serif;"></div>
        </div>
        <script>
            function showTime() {
                var date = new Date();
                var hari = date.toLocaleString("id-ID", { weekday: "long" });
                var tanggal = date.getDate();
                var bulan = date.toLocaleString("id-ID", { month: "long" });
                var tahun = date.getFullYear();
                var waktu = hari + ", " + tanggal + " " + bulan + " " + tahun;
                document.getElementById("waktu").innerHTML = waktu;
            }

            showTime();
            setInterval(showTime, 1000);
        </script>
        <!-- Navbar-->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="dsh_barang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt mr-1"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-table-columns mr-1"></i></div>
                            Stock Barang</span>
                        </a>
                        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGudang"
                            aria-expanded="false" aria-controls="collapseGudang">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-warehouse"></i></div>
                            <span style="padding-left: 10px;">Daftar Gudang</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseGudang" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="df_gd1.php">Gudang 1</a>
                                <a class="nav-link" href="df_gd2.php">Gudang 2</a>
                                <a class="nav-link" href="df_gd3.php">Gudang 3</a>
                                <a class="nav-link" href="df_gd4.php">Gudang 4</a>
                            </nav>
                        </div> -->
                        <a class="nav-link" href="cs_page.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users mr-1"></i></div>
                            Customer
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInterface"
                            aria-expanded="false" aria-controls="collapseInterface">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                            <span style="padding-left: 10px;">Transaksi Barang</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseInterface" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="masuk.php">Barang Masuk / In</a>
                                <a class="nav-link" href="keluar.php">Barang Keluar / Out</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="mng_admin.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie mr-1"></i></div>
                            Admin
                        </a>
                        <a class="nav-link" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span style="padding-left: 10px;">Logout</span>
                        </a>
                    </div>
                </div>
                <!-- Menampilkan Login Session User -->
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: </div>
                    <i><?= $email; ?></i>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4 mb-4">DAFTAR BARANG</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a>Home</a></li>
                    </ol>
                    <div class="row mt-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h5 href="#" class="d-flex align-items-center text-white">
                                        <i class="fa-solid fa-box mr-2"></i>
                                        Total Barang
                                    </h5>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <a href="#" class="text-white">
                                        <h2><?= number_format($jumlah_brg); ?></h2>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h5 class="text-white">
                                        <i class="fa-solid fa-dolly mr-2"></i>
                                        Total Data Barang Masuk
                                    </h5>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <a href="#" class="text-white">
                                        <h2><?= number_format($jumlah_msk); ?></h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <h5 href="#" class="d-flex align-items-center text-white">
                                        <i class="fa-solid fa-truck-arrow-right mr-2"></i>
                                        Total Data Barang Keluar
                                    </h5> 
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <a href="#" class="text-white">
                                        <h2><?= number_format($jumlah_klr); ?></h2>
                                        <!-- <h2>$jumlah_klr >= 1000000 ? number_format($jumlah_klr / 1000000, 1) . 
                                        'M' : ($jumlah_klr >= 1000 ? number_format($jumlah_klr / 1000, 1) . 
                                        'K' : $jumlah_klr); ?> -->
                                    </h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row mt-3">
                                <div class="col">
                                    <form method="post" class="form-inline">
                                        <select name="customer" class="form-control">
                                            <option value="">Pilih Customer</option>
                                            
                                        </select>
                                        <button type="submit" name="filter_dtbrg" class="btn btn-primary ml-3">
                                            <i class="fa-solid fa-sort"></i> Filter Data Barang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="row">
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <?php if ($row['image'] != null) : ?>
                    <img src="gambar/<?= $row['image']; ?>" class="card-img-top zoomable" alt="<?= $row['namabarang']; ?>">
                <?php else : ?>
                    <img src="gambar/default.png" class="card-img-top zoomable" alt="No Image">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= $row['namabarang']; ?></h5>
                    <p class="card-text">
                        <strong>Deskripsi:</strong> <?= $row['kd']; ?><br>
                        <strong>Stok:</strong> <?= number_format($row['stock']); ?><br>
                        <strong>Lokasi:</strong> <?= $row['lokasi']; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
                        </div>

                    </div>

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; MHS UBSI <?php echo date("Y"); ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>

</body>

</html>
