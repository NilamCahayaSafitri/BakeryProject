<?php
session_start();
include "connect.php";
$message = "";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";


if (!empty($_POST['proses_siap_validate'])) {
        $query = mysqli_query($conn, "UPDATE tb_list_order SET status=3
        WHERE id_list_order='$id'");
        if ($query) {
                $message = '<script>alert("Kirim ke Alamat Tujuan");
                        window.location="../delivery"</script>';
        } else {
                $message = '<script>alert("Pengiriman Gagal");
                        window.location="../delivery"</script>';
        }
}
echo $message;
?>