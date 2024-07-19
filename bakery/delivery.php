<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya  FROM tb_list_order
    LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
    LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
    GROUP BY id_list_order");


$result = [];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    //$kode = $record['id_order'];
    //$pelanggan = $record['pelanggan'];
}

$select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM tb_daftar_menu");
?>

<div class="col-lg-9  mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Order Item
        </div>
        <div class="card-body">


            <?php
            if (empty($result)) {
                echo "Data menu tidak ada";
            } else {
                foreach ($result as $row) {
            ?>


                    <!-- Modal Selesai Delivery -->
                    <div class="modal fade" id="selesai<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Pengiriman</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_selesai_kirim.php" method="POST">
                                        <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id">
                                        <div class="col-lg-12">
                                            Apakah Pesanan Telah Diterima Oleh <b><?php echo $row['pelanggan'] ?> </b> Dengan Kode Order <b><?php echo $row['kode_order'] ?> </b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="proses_selesai_validate" value="12345">Konfirmasi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Selesai Delivery -->

                <?php
                }
                ?>


                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                                if ($row['status'] != 1) {
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $no++ ?>
                                        </td>
                                        <td>
                                            <?php echo $row['kode_order'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['pelanggan'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Alamat'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['nama_menu'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['jumlah'] ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($row['harganya'], 0, ',', '.') ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['status'] == 1) {
                                                echo "<span class='badge text-bg-warning'>Order dikemas</span>";
                                            } elseif ($row['status'] == 2) {
                                                echo "<span class='badge text-bg-primary'>Order dikirim</span>";
                                            } elseif ($row['status'] == 3) {
                                                echo "<span class='badge text-bg-info'>Selesai</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="<?php echo (empty($row['status']) || $row['status'] != 2) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-success btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#selesai<?php echo $row['id_list_order'] ?>">Selesai</button>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>