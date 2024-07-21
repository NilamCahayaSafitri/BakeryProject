<?php 
include "proses/connect.php";
$query_chart = mysqli_query($conn, "SELECT nama_menu, tb_daftar_menu.id, SUM(tb_list_order.jumlah) AS total_jumlah
FROM tb_daftar_menu
LEFT JOIN tb_list_order ON tb_daftar_menu.id = tb_list_order.menu
GROUP BY tb_daftar_menu.id
ORDER BY tb_daftar_menu.id ASC");

//$result_chart = array();
while($record_chart = mysqli_fetch_array($query_chart)){
    $result_chart[] = $record_chart;
}

$array_menu = array_column($result_chart, 'nama_menu');
$array_menu_qoute = array_map(function ($menu){
    return "'".$menu."'";
}, $array_menu);
$string_menu = implode(',', $array_menu_qoute);
//echo $string_menu."<br/>";

$array_jumlah_pesanan = array_column($result_chart, 'total_jumlah');
$string_jumlah_pesanan = implode(',', $array_jumlah_pesanan);
//echo $string_jumlah_pesanan;

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="col-lg-9  mt-2">
<!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner rounded">
            <div class="carousel-item active">
                <img src="assets/img/32.png" class="img-fluid" style="height: 300px; width:1000px; object-fit:cover" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Selamat Datang di NilBakery</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/img/30.png" class="img-fluid" style="height: 300px; width:1000px; object-fit:cover" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h5>Churros</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/img/31.png" class="img-fluid" style="height: 300px; width:1000px; object-fit:cover" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/img/34.png" class="img-fluid" style="height: 300px; width:1000px; object-fit:cover" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Akhir Carousel -->

    <!-- Judul -->
    <div class="card mt-4 border-0">
        <div class="card-body text-center">
            <h5 class="card-title"><b>NILBAKERY</b></h5>
            <p align="justify" class="card-text">Selamat datang di <b>NilBakery</b>, tempat di mana setiap gigitan
                adalah perjalanan kelezatan. Kami menyajikan kue-kue yang dibuat dengan cinta dan bahan-bahan
                terbaik, menghadirkan manisnya kebahagiaan dalam setiap potongan. Dari oven kami ke meja Anda,
                setiap produk kami dibuat dengan teliti untuk memastikan kualitas dan rasa yang tak terlupakan.
                Nikmati sensasi lembutnya adonan yang dipanggang sempurna, diiringi aroma harum yang membangkitkan
                kenangan manis. Ciptakan momen-momen istimewa bersama keluarga dan teman-teman dengan kelezatan
                yang kami tawarkan. Di <b>NilBakery</b>, setiap hari menjadi lebih manis dengan kue-kue buatan
                rumah yang penuh kasih.</p>
            <a href="order" class="btn btn-primary">Go Order</a>
        </div>
    </div>
    <!-- Akhir Judul -->

    <!-- Chart -->
    <div class="card mt-4 border-0">
        <div class="card-body text-center">
            <div>
                <canvas id="myChart"></canvas>
            </div>
            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php echo $string_menu ?>],
                        datasets: [{
                            label: 'Menu Terfavorite',
                            data: [<?php echo $string_jumlah_pesanan ?>],
                            borderWidth: 1,
                            backgroundColor:[
                                'rgba(244, 8, 26, 0.8)',
                                'rgba(8, 52, 226, 0.8)',
                                'rgba(231, 207, 25, 0.8)',
                                'rgba(23, 154, 49, 0.8)',
                                'rgba(107, 8, 182, 0.8)',
                                'rgba(240, 123, 11, 0.8)',
                                'rgba(12, 182, 199, 0.8)',
                                'rgba(199, 12, 46, 0.8)',
                                'rgba(19, 199, 12, 0.8)',
                                'rgba(68, 4, 148, 0.8)',
                                'rgba(177, 12, 199, 0.8)',
                                'rgba(253, 111, 184, 0.8)',
                                'rgba(187, 225, 50, 0.8)',
                                'rgba(50, 169, 225, 0.8)',
                                'rgba(50, 225, 182, 0.8)'
                            ]
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    <!-- Akhir Chart -->
</div>