<?php 
include "connect.php";
$message = "";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;


if(!empty($_POST['input_user_validate'])){
    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id='$id'");
    if($query){
        $message = '<scrip>alert("Data berhasil dihapus");
                    window.location="../user" </script>';
    }else{
        $message = '<script>alert("Data gagal dihapus");
                    window.location="../user" </script>';
    }
}echo $message;
?>
