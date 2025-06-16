<?php
require 'koneksi.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stock App - Dashboard</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/b79720072c.js" crossorigin="anonymous"></script>
    
    <!--CSS GAMBAR -->
    <style>
        .zoomable{
            width: 100px;
        }
        .zoomable:hover{
            transform: scale(2.0);
            transition: 0.3s ease;
        }

    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Dashboard</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar-->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                       
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                            <span style="padding-left: 10px;">Transaksi Barang</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="masuk.php">Barang Masuk / In</a>
                                <a class="nav-link" href="keluar.php">Barang Keluar / Out</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span style="padding-left: 10px;">Logout</span>
                        </a>
                    </div>
                </div>
                <!-- Menampilkan Login Session User -->
                <?php
                    $sel = "SELECT * FROM login";
                    $login = mysqli_query($conn, $sel);
                    $log = mysqli_fetch_assoc($login);
                ?>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $log['email'];?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Stock Barang</h1><br>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal --> <!-- -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa-solid fa-plus"></i> Tambah Barang
                            </button>
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Kode Barang</th>
                                            <th>Kategori</th>
                                            <th>Stock</th>
                                            <th>Satuan</th>
                                            <th>Location</th>
                                            <th style="text-align: center">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambilsemuadata = mysqli_query($conn, "select * from stock");
                                        $i=1;
                                        while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                            $kd = $data['kd'];
                                            $namabarang = $data['namabarang'];
                                            $kategori = $data['kategori'];
                                            $stock = $data['stock'];
                                            $satuan = $data['satuan'];
                                            $lokasi = $data['lokasi'];
                                            $idbrg = $data['idbarang'];

                                            $gambar =$data['gambar'];
                                            if ($gambar == NULL) {
                                                # Jika Tidak ada FILE GAMBAR
                                                $img = 'NULL';
                                            } else {
                                                # Jika Ada FILE GAMBAR
                                                $img = '<img src="uploads/'.$gambar.'" class="zoomable">';
                                            }

                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$img;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$kd;?></td>
                                            <td><?=$kategori;?></td>
                                            <td><strong><?=$stock;?></strong></td>
                                            <td><?=$satuan;?></td>
                                            <td><?=$lokasi;?></td>
                                            <td style="text-align: center">
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#edit<?=$idbrg;?>">
                                                    <i class="fa-regular fa-pen-to-square"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete<?=$idbrg;?>">
                                                    <i class="fa-solid fa-trash-can"></i> Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- EDIT Modal -->
                                        <div class="modal fade" id="edit<?=$idbrg;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header EDIT -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Form Edit Barang</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body EDIT -->
                                                    <form method="post"enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <label>Nama Barang</label>
                                                            <input type="text" name="namabarang"
                                                                value="<?=$namabarang;?>" class="form-control" required>
                                                            <br>
                                                            <label>Part Name</label>
                                                            <input type="text" name="kd" value="<?=$kd;?>"
                                                                class="form-control" required>
                                                            <br>
                                                            <label>kategori</label>
                                                             <select class="form-control"  name="kategori" aria-label="Default select example" required>
                                                                <option selected><?=$kategori;?></option>
                                                                <option value="Bahan Mentah">Bahan Mentah</option>
                                                                <option value="Bahan Jadi">Bahan Jadi</option>
                                                            </select>
                                                            <br>
                                                            <label>Stock Barang</label>
                                                            <input type="number" name="stock" value="<?=$stock;?>"
                                                                class="form-control">
                                                            <br>
                                                            <label>Satuan</label>
                                                            <select name="satuan" class="form-control" required>
                                                                <option selected><?=$satuan;?></option>
                                                                <option value="Kg">Kg</option>
                                                                <option value="Gram">Gr</option>
                                                                <option value="Liter">ltr</option>
                                                            </select>
                                                            <br>
                                                            <label>lokasi</label>
                                                            <input type="text" name="lokasi" value="<?=$lokasi;?>"
                                                                class="form-control">
                                                             <br>   
                                                            <div class="row mb-3">
                                                                <div class="col">
                                                                    <label><b>File Image</b></label>
                                                                    <input type="file" name="file" class="form-control"></input>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <!-- type="hidden" u/ Trigger Modal (EDIT) -->
                                                            <input type="hidden" name="idbarang"
                                                                value="<?=$idbrg;?>"></input>
                                                            <button type="submit" class="btn btn-primary"
                                                                name="updatebarang">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="delete<?=$idbrg;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header DELETE -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Barang tersebut?</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body DELETE -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            Anda Yakin, Ingin Hapus Barang <strong><?=$namabarang?>
                                                                (<?=$kd;?>)</strong> ?
                                                            <br>
                                                            <br>
                                                            <!-- type="hidden" u/ Trigger Modal (EDIT) -->
                                                            <input type="hidden" name="idbarang"
                                                                value="<?=$idbrg;?>"></input>
                                                            <button type="submit" class="btn btn-danger"
                                                                name="hapusbarang">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <a href="exportstock.php" target="_blank" class="btn btn-info">Export Data</a>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2024</div>
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

<!-- The Modal (TAMBAH BARANG) -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header (TAMBAH BARANG) -->
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body (TAMBAH BARANG)-->
            <form method="post"enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Nama Barang</label>
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                    <br>
                    <label>Kode Barang</label>
                    <input type="text" name="kd" placeholder="kode Barang" class="form-control" required>
                    <br>
                    <label>Kategori</label>
                    <select class="form-control"  name="kategori" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="Bahan Mentah">Bahan Mentah</option>
                        <option value="Bahan Jadi">Bahan Jadi</option>
                    </select>
                    <br>
                    <label>Stock Barang</label>
                    <input type="number" name="stock" placeholder="Quantity" class="form-control" required>
                    <br>
                    <label>Satuan</label>
                    <select name="satuan" class="form-control" required>
                        <option value="kg">Kg</option>
                        <option value="gram">Gram</option>
                    </select>
                    <br>
                    <label>Location</label>
                    <input type="text" name="lokasi" placeholder="Spesifikasi Barang" class="form-control" required>
                    <br>
                    <div class="row mb-3">
                        <div class="col">
                            <label><b>File Image</b></label>
                            <input type="file" name="file" class="form-control"></input>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>