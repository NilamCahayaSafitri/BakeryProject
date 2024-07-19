<?php
session_start();
include "connect.php";
$message = "";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$Alamat = (isset($_POST['Alamat'])) ? htmlentities($_POST['Alamat']) : "";

if (!empty($_POST['edit_order_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order = '$kode_order'");
        $query = mysqli_query($conn, "UPDATE tb_order SET pelanggan='$pelanggan',Alamat='$Alamat'
        WHERE id_order = '$kode_order'");
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan");
                    window.location="../order "</script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan");
                        window.location="../order "</script>';
        }
}
echo $message;
