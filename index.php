<!DOCTYPE html>
<html lang="en">
<?php require "layout/head.php";?>
<body>
    <div id="app">
        <?php require "layout/sidebar.php";?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Dashboard</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="text-center">Sistem Penunjang Keputusan Karyawan Terbaik</h2>
                            </div>
                            <div class="card-content">
                                <div class="card-body pt-1">
                                    <p class="card-text">
										Sistem Penunjang Keputusan merupakan suatu sistem informasi spesifik yangdirancang untuk membantu manajemen dalam
										pengambilan keputusan yang berkaitan dengan persoalan yang bersifat semiterstruktur dengan menggunakan data, model,
										dan alat analisis. Simple Additive Weighting (SAW) digunakan dalam sistempenunjang keputusan untuk menghitung nilai
										preferensi relatif dari sejumlah alternatif berdasarkan beberapa kriteria.
									</p>
										Metode SAW mengubah semua kriteria dan bobot yang terkait menjadi skalanilai relatif, dan kemudian menggabungkan skala
										nilai tersebut untuk menghasilkan skor akhir yang menunjukkan peringkatatau preferensi relatif dari setiap alternatif.
										Konsep dasar pada metode SAW adalah mencari penjumlahan terbobot darirating kinerja pada setiap alternatif di semua atribut.
                                    </p>
                                    <hr>
                                    <p class="card-text">
                                        Langkah Penyelesaian Simple Additive Weighting (SAW) adalah sebagaiberikut:
                                    </p>
                                    <ol>
                                        <li>
                                            Menentukan kriteria-kriteria yang akan dijadikan acuan dalampengambilan
                                            keputusan, yaitu (Ci).
                                        </i>
                                        <li>
                                            Menentukan rating kecocokan setiap alternatif pada setiap kriteria(X).
                                        </li>
                                        <li>
                                            Membuat matriks keputusan berdasarkan kriteria (Ci), kemudianmelakukan
                                            normalisasi matriks berdasarkan persamaan yang disesuaikan denganjenis
                                            atribut (atribut keuntungan/benefit ataupun atribut biaya/cost)sehingga diperoleh
                                            matriks ternormalisasi (R).
                                        </li>
                                        <li>
                                            Hasil akhir diperoleh dari proses perankingan yaitu penjumlahan dari
                                            perkalian matriks ternormalisasi R dengan vektor bobot sehingga
                                            diperoleh nilai terbesar yang dipilih sebagai alternatif terbaik
                                            (Ai) sebagai solusi
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php require "layout/footer.php";?>
        </div>
    </div>
    <?php require "layout/js.php";?>
</body>
</html>