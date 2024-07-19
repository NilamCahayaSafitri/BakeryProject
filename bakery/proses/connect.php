<?php 
    $conn = mysqli_connect("localhost","root","","db_bakery");
    if(!$conn){
        echo "Gagal koneksi";
    }
?>