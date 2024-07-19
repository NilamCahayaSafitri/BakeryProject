<?php
session_start();
include "connect.php";
$message = "";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";


if (!empty($_POST['kirim_orderitem_validate'])) {
        $query = mysqli_query($conn, "UPDATE tb_list_order SET catatan='$catatan',status=2 
        WHERE id_list_order='$id'");
        if ($query) {
                $message = '<script>alert("Order Dalama Pengiriman");
                        window.location="../karyawan"</script>';
        } else {
                $message = '<script>alert("Gagal Dikirim");
                        window.location="../karyawan"</script>';
        }
}
echo $message;
?>