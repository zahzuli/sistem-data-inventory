<?php
//import koneksi ke database
require 'koneksi.php';
require 'cek.php';
?>
<html>

<head>
    <title>Daftar Barang Keluar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
    </script>
</head>

<body>
    <div class="container">
        <h2>Barang Keluar</h2>
        <h4>(Stock App)</h4>
        <div class="data-tables datatable-dark">
            <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Part Name</th>
                        <th>Spesifikasi</th>
                        <th>Produsen</th>
                        <th>Jumlah Keluar</th>
                        <th>Penerima</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $ambilsemuadata = mysqli_query($conn, "select * from keluar k, stock s where s.idbarang = k.idbarang");
                        $i=1;
                        while ($data = mysqli_fetch_array($ambilsemuadata)) {
                            $tanggalklr = $data['tanggal'];
                            $kd = $data['kd'];
                            $namabarang = $data['namabarang'];
                            $spek = $data['spek'];
                            $produsen = $data['produsen'];
                            $qty = $data['qty'];
                            $penerima = $data['penerima'];
                            $idbrg = $data['idbarang'];
                            $idk = $data['idkeluar'];
                    ?>
                    <tr>
                        <td><?=$i++;?></td>
                        <td><?=$tanggalklr;?></td>
                        <td><?=$namabarang;?></td>
                        <td><?=$kd;?></td>
                        <td><?=$spek;?></td>
                        <td><?=$produsen;?></td>
                        <td><strong><?=$qty;?></strong></td>
                        <td><?=$penerima;?></td>
                    </tr>

                    <?php
                        };
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#dataTable3').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>