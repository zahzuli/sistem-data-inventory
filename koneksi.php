<?php

session_start();
//Koneksi Database
$conn = mysqli_connect("localhost","root","","inventory_db");

// //Tambah Barang Baru
// if (isset($_POST['addnewbarang'])) 
// {
//     $kd = $_POST['kd'];
//     $namabarang = $_POST['namabarang'];
//     $kategori = $_POST['kategori'];
//     $stock = $_POST['stock'];
//     $satuan = $_POST['satuan'];
//     $lokasi = $_POST['lokasi'];

//     // Ada file yang diupload
//         $allowed_extensions = array('png','jpg','jpeg');
//         $nama = $_FILES['file']['name']; //nama file
//         $dot = explode('.',$nama);
//         $ekstensi = strtolower(end($dot)); //ekstensi
//         $ukuran = $_FILES['file']['size']; //size
//         $file_tmp = $_FILES['file']['tmp_name']; //temporary

//         // Penamaan file -> enkripsi
//         $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi;

//         // Validasi file yang diupload
//         if(in_array($ekstensi, $allowed_extensions) === true) {
//             // Validasi ukuran file
//             if($ukuran < 10000000) {
//                 move_uploaded_file($file_tmp, 'uploads/'.$image);
//             }

//     $addtotable = mysqli_query($conn, "insert into stock (kd, namabarang, kategori, stock, satuan, lokasi) values('$kd', '$namabarang',  '$kategori', '$stock', '$satuan', '$lokasi')");

//     if ($addtotable) {
//         header('location:index.php');
//     } else {
//         header('location:index.php');
//     }
// }
// }

if (isset($_POST['addnewbarang'])) {
    $kd = $_POST['kd'];
    $namabarang = $_POST['namabarang'];
    $kategori = $_POST['kategori'];
    $stock = $_POST['stock'];
    $satuan = $_POST['satuan'];
    $lokasi = $_POST['lokasi'];

    $image = null; // default jika tidak upload gambar

    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $allowed_extensions = ['png', 'jpg', 'jpeg'];
        $nama = $_FILES['file']['name'];
        $dot = explode('.', $nama);
        $ekstensi = strtolower(end($dot));
        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi;

        // Validasi ekstensi
        if (in_array($ekstensi, $allowed_extensions)) {
            // Validasi ukuran
            if ($ukuran < 100000000) {
                move_uploaded_file($file_tmp, 'uploads/' . $image);
            } else {
                echo "Ukuran file terlalu besar.";
                exit;
            }
        } else {
            echo "Ekstensi file tidak diizinkan.";
            exit;
        }
    }

    // Simpan ke database (masukkan nama file gambar)
    $addtotable = mysqli_query($conn, "INSERT INTO stock 
        (kd, namabarang, kategori, stock, satuan, lokasi, gambar) 
        VALUES 
        ('$kd', '$namabarang', '$kategori', '$stock', '$satuan', '$lokasi', '$image')");

    if ($addtotable) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal menyimpan ke database: " . mysqli_error($conn);
    }
}


//Tambah Barang Masuk
if (isset($_POST['barangmasuk'])) 
{
    $tanggalmsk = date('Y-m-d', strtotime($_POST['tanggal']));
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahstock = $stocksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, tanggal, keterangan, qty) values('$barangnya', '$tanggalmsk', '$penerima','$qty')");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahstock' where idbarang='$barangnya'");
    if ($addtomasuk&&$updatestockmasuk) {
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }

}

//Tambah Barang Keluar
if (isset($_POST['addbarangkeluar'])) 
{
    $tanggalklr = date('Y-m-d', strtotime($_POST['tanggal']));
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahstock = $stocksekarang - $qty;

    $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, tanggal, penerima, qty) values('$barangnya', '$tanggalklr','$penerima','$qty')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahstock' where idbarang='$barangnya'");
    if ($addtokeluar&&$updatestockmasuk) {
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }

}

//UPDATE Info Barang
if (isset($_POST['updatebarang'])) {
    $idbrg = $_POST['idbarang'];
    $kd = $_POST['kd'];
    $namabarang = $_POST['namabarang'];
    $kategori = $_POST['kategori'];
    $stock = $_POST['stock'];
    $satuan = $_POST['satuan'];
    $lokasi = $_POST['lokasi'];


    $image = null;

    // Ambil gambar lama untuk referensi
    $ambil = mysqli_query($conn, "SELECT gambar FROM stock WHERE idbarang='$idbrg'");
    $data = mysqli_fetch_assoc($ambil);
    $gambar_lama = $data['gambar'];

    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $allowed_extensions = ['png', 'jpg', 'jpeg'];
        $nama = $_FILES['file']['name'];
        $dot = explode('.', $nama);
        $ekstensi = strtolower(end($dot));
        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi;

        if (in_array($ekstensi, $allowed_extensions)) {
            if ($ukuran < 10000000) {
                // Hapus gambar lama jika perlu
                if (!empty($gambar_lama) && file_exists("uploads/" . $gambar_lama)) {
                    unlink("uploads/" . $gambar_lama);
                }
                move_uploaded_file($file_tmp, 'uploads/' . $image);
            } else {
                echo "Ukuran file terlalu besar.";
                exit;
            }
        } else {
            echo "Ekstensi file tidak diizinkan.";
            exit;
        }
    }

    // Query Update, cek apakah gambar diubah atau tidak
    if ($image) {
        $updateinfo = mysqli_query($conn, "UPDATE stock 
            SET kd='$kd', namabarang='$namabarang', kategori='$kategori', stock='$stock', satuan='$satuan', lokasi='$lokasi', gambar='$image' 
            WHERE idbarang='$idbrg'");
    } else {
        $updateinfo = mysqli_query($conn, "UPDATE stock 
            SET kd='$kd', namabarang='$namabarang', kategori='$kategori', stock='$stock', satuan='$satuan', lokasi='$lokasi' 
            WHERE idbarang='$idbrg'");
    }

    if ($updateinfo) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}


//Hapus Barang dari Stock
if (isset($_POST['hapusbarang'])) {
    $idbrg = $_POST['idbarang'];

    $hapusbrgstck = mysqli_query($conn, "delete from stock where idbarang='$idbrg'");
    if ($hapusbrgstck) {
        header('location:index.php');
    } else {
        header('location:index.php');
    }
}


// Ubah Data Barang Masuk
if (isset($_POST['updatebarangmasuk'])) {
    $idbrg = $_POST['idbarang'];
    $idm = $_POST['idm'];
    $tanggalmsk = date('Y-m-d', strtotime($_POST['tanggal']));
    $qty = $_POST['qty'];
    $deskripsi = $_POST['keterangan'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idbrg'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    // Perbaikan ada di sini
    $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idbrg'");
        $updatenya = mysqli_query($conn, "update masuk set tanggal='$tanggalmsk', qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");

        if ($kurangistocknya && $updatenya) {
            header('location:masuk.php');
        } else {
            header('location:masuk.php');
        }

    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idbrg'");
        $updatenya = mysqli_query($conn, "update masuk set tanggal='$tanggalmsk', qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");

        if ($kurangistocknya && $updatenya) {
            header('location:masuk.php');
        } else {
            header('location:masuk.php');
        }
    }
}

//Hapus Barang Masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idbrg = $_POST['idbarang'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idbrg'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock - $qty;
    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idbrg'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if ($update&&$hapusdata) {
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }

}

//BATAS FUNCTION Barang Masuk

// Ubah Data Barang Keluar (Kebalikan dari Barang Masuk)
if (isset($_POST['updatebarangkeluar'])) {
    $idbrg = $_POST['idbarang'];
    $idk = $_POST['idk'];
    $tanggalklr = date('Y-m-d', strtotime($_POST['tanggal']));
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];

    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idbrg'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idbrg'");
        $updatenya = mysqli_query($conn, "update keluar set tanggal='$tanggalklr', qty='$qty', penerima='$penerima' where idkeluar='$idk'");

        if ($kurangistocknya && $updatenya) {
            header('location:keluar.php');
        } else {
            header('location:keluar.php');
        }

    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idbrg'");
        $updatenya = mysqli_query($conn, "update keluar set tanggal='$tanggalklr', qty='$qty', penerima='$penerima' where idkeluar='$idk'");

        if ($kurangistocknya && $updatenya) {
            header('location:keluar.php');
        } else {
            header('location:keluar.php');
        }
    }
}


//Hapus Barang Keluar (Kebalikan dari Barang Masuk)
if (isset($_POST['hapusbarangkeluar'])) {
    $idbrg = $_POST['idbarang'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idbrg'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock + $qty;
    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idbrg'");
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if ($update&&$hapusdata) {
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }

}
?>