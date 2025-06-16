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
    <title>Stock App - Barang Keluar</title>
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
        <a class="navbar-brand" href="index.php">Stock App</a>
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
                    <h1 class="mt-4">Barang Keluar</h1><br>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                                <i class="fa-solid fa-plus"></i> Barang Keluar
                            </button>
                            <div class="row mt-4">
                            <div class="col">

                            <form method ="post" class="form-inline">
                                <input type ="date" name= "tgl_mulaiklr" class = "form-control">
                                <input type ="date" name= "tgl_selesaiklr" class = "form-control ml-3">
                                <button type = "submit" name = "filter_klr" class ="btn btn-info ml-3"> Filter</button>
</form>
                        </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Kode barang</th>
                                            <th>Kategori</th>
                                            <th>Jumlah Keluar</th>
                                            <th>Penerima</th>
                                            <th style="text-align: center">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                              if (isset($_POST['filter_klr'])) {
                                                $start_klr = $_POST['tgl_mulaiklr'];
                                                $end_klr = $_POST['tgl_selesaiklr'];
                                                
                                                
                                                // Buat query dasar
                                                $query = "SELECT k.*, s.* FROM keluar k JOIN stock s ON s.idbarang = k.idbarang";
                                                
                                                // Tambahkan filter tanggal jika ada
                                                if ($start_klr != NULL && $end_klr != NULL) {
                                                    $query .= " WHERE k.tanggal BETWEEN '$start_klr' AND '$end_klr'";
                                                } else {
                                                     // Tambahkan sorting DESC berdasarkan tanggal
                                                    $query .= " ORDER BY k.tanggal DESC";
                                                }
                                                
                                                // Eksekusi query
                                                $ambilsemuadata = mysqli_query($conn, $query);
                                                
                                            } else {
                                                // Query default tanpa filter, tampilkan data tiga bulan terakhir dengan sorting DESC
                                                $ambilsemuadata = mysqli_query($conn, "SELECT k.*, s.* FROM keluar k JOIN stock s ON s.idbarang = k.idbarang WHERE k.tanggal ORDER BY k.tanggal DESC");
                                            }
                                            $i=1;
                                            while ($data = mysqli_fetch_array($ambilsemuadata)) {
                                                $tanggalklr = $data['tanggal'];
                                                $kd = $data['kd'];
                                                $namabarang = $data['namabarang'];
                                                $kategori = $data['kategori'];
                                                $qty = $data['qty'];
                                                $penerima = $data['penerima'];
                                                $idbrg = $data['idbarang'];
                                                $idk = $data['idkeluar'];

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
                                                <td><?=$tanggalklr;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$kd;?></td>
                                                <td><?=$kategori;?></td>
                                                <td><strong><?=$qty;?></strong></td>
                                                <td><?=$penerima;?></td>
                                                <td style="text-align: center">
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idk;?>">
                                                    <i class="fa-regular fa-pen-to-square"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idk;?>">
                                                    <i class="fa-solid fa-trash-can"></i> Delete
                                                </button>
                                                </td>
                                            </tr>

                                            <!-- EDIT Modal -->
                                            <div class="modal fade" id="edit<?=$idk;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header EDIT -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Form Edit Barang Keluar</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body EDIT -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <label for="">Tanggal Masuk (MM-DD-YYYY)</label>
                                                                <input type="date" name="tanggal" value="<?=$tanggalklr;?>" class="form-control" readonly>
                                                                <br>
                                                                <label>Nama Barang</label>
                                                                <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" readonly>
                                                                <br>
                                                                <label>Part Name</label>
                                                                <input type="text" name="kd" value="<?=$kd;?>" class="form-control" readonly>
                                                                <br>
                                                                <label>Kategori</label>
                                                                <input type="text" name="kategori" value="<?=$kategori;?>" class="form-control" readonly>
                                                                <br>
                                                                <label>Jumlah Keluar</label>
                                                                <input type="number" name="qty" value="<?=$qty;?>" class="form-control" required>
                                                                <br>
                                                                <label>Penerima</label>
                                                                <input type="text" name="penerima" value="<?=$penerima;?>" class="form-control" required>
                                                                <br>
                                                                <!-- type="hidden" u/ Trigger Modal (EDIT) -->
                                                                <input type="hidden" name="idbarang" value="<?=$idbrg;?>"></input>
                                                                <input type="hidden" name="idk" value="<?=$idk;?>"></input>
                                                                <button type="submit" class="btn btn-primary"
                                                                    name="updatebarangkeluar">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- DELETE Modal -->
                                            <div class="modal fade" id="delete<?=$idk;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header DELETE -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Barang tersebut?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body DELETE -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Anda Yakin, Ingin Hapus Barang <strong><?=$namabarang?> (<?=$kd;?>)</strong> ?
                                                                <br>
                                                                <br>
                                                                <!-- type="hidden" u/ Trigger Modal (DELETE) -->
                                                                <input type="hidden" name="idbarang" value="<?=$idbrg;?>"></input>
                                                                <input type="hidden" name="kty" value="<?=$qty;?>"></input>
                                                                <input type="hidden" name="idk" value="<?=$idk;?>"></input>
                                                                <button type="submit" class="btn btn-danger"
                                                                    name="hapusbarangkeluar">Hapus</button>
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
                            </div><br>
                            <a href="exportkeluar.php" target="_blank" class="btn btn-info">Export Data</a>
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

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Barang Keluar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <label for="">Tanggal Masuk</label>
                    <input type="date" name="tanggal" class="form-control" required>
                    <br>
                    <label>Kode Barang</label>
                    <select name="barangnya" class="form-control">
                        <?php
                        $ambilsemuadata = mysqli_query($conn, "select * from stock");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadata)) {
                            $kdnya = $fetcharray['kd'];
                            $namabarangnya = $fetcharray['namabarang'];
                            $idbarangnya = $fetcharray['idbarang'];
                            ?>
                        <option value="<?=$idbarangnya; ?>"><?=$namabarangnya;?><?="  ($kdnya)";?></option>

                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <label>Quantity</label>
                    <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
                    <br>
                    <label>Penerima</label>
                    <input type="text" name="penerima" placeholder="Penerima" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addbarangkeluar">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>