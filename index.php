<?php include_once "process_prediction.php"; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://www.yarsi.ac.id/bio/assets/images/yarsi3.png">

    <title>Prediksi Stunting</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Graphic JS in several Data -->
    <script type="text/javascript" src="js-main/visualization.js"></script>


</head>

<body class="bg-light">

    <!-- <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Prediksi Stunting</a>
        <button class="navbar-toggler p-0 border-0" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav> -->

    <main role="main" class="container" style="margin-top:5%;">
        <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow alert-primary">
            <img class="mr-3" src="https://www.yarsi.ac.id/bio/assets/images/yarsi3.png" alt="" width="63" height="63">
            <div class="lh-100">
                <h5 class="mb-0 text-green lh-100">Prediksi Stunting</h5>
                <small>Since 2020</small>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0">Grafik Data Stunting</h6>

            <div class="container">
                <div class="row" style="margin: 1%;">
                    <select class="form-control" name="numberIndexGraph" id="numberIndexGraph" onchange="myFunctionGraph(this)">
                        <option disabled selected>Pilih...</option>
                        <option value="20">Usia Baduta (Bulan)</option>
                        <option value="29">Berat Badan Baduta (kg)</option>
                        <option value="30">Panjang Badan Baduta</option>
                        <option value="32">Status Gizi Baduta</option>
                    </select>
                    <div id="chartUsia" style="height: 370px; width: 100%; margin-top: 2%;display: none;"></div>
                </div>
                <!--  -->
                <div class="row" style="margin-top: 3%;">
                    <div class="col-sm">
                        <div class="alert alert-primary text-black" style="font-size: 20px; text-align: center;" role="alert">
                            <b>Nilai Akurasi</b><br>
                            <?php echo $numberAccuracy ?>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="alert alert-success" style="font-size: 20px; text-align: center;" role="alert">
                            <b>Nilai Precision</b><br>
                            <?php echo $numberPrecision ?>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="alert alert-info" style="font-size: 20px; text-align: center;" role="alert">
                            <b>Nilai Recall</b><br>
                            <?php echo $numberRecall ?>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="alert alert-dark" style="font-size: 20px; text-align: center;" role="alert">
                            <b>Nilai F1 Score</b><br>
                            <?php echo $numberF1Score ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <small class="d-block text-right mt-3">
                <a href="#">Refresh</a>
            </small> -->
        </div>

        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0">Masukkan Data dan Prediksi</h6>

            <!-- Hasil Prediksi -->
            <?php
            if ($message != "") {
                // Jika mau gunain alert biasa
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' style='margin:2%;'>
                            <strong>Hasil Prediksi !</strong> $message.
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                // Jika mau gunain alert box
                // echo "<script type='text/javascript'>alert('$message');</script>";
                $message = "";
            }
            ?>

            <!-- Form Prediction Begin -->
            <form action="" method="post" style="margin: 2%;">

                <div class="form-group">
                    <label for="formGroupExampleInput">Nama Ibu</label>
                    <input type="text" class="form-control" id="Nama_Ibu" name="Nama_Ibu" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Alamat</label>
                    <input type="text" class="form-control" id="Alamat" name="Alamat" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Kecamatan</label>
                    <input type="text" class="form-control" id="Kecamatan" name="Kecamatan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Desa</label>
                    <input type="text" class="form-control" id="Desa" name="Desa" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Nomer_NIK</label>
                    <input type="text" class="form-control" id="Nomer_NIK" name="Nomer_NIK" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">TB_Ibu</label>
                    <input type="text" class="form-control" id="TB_Ibu" name="TB_Ibu" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">BB_Ibu</label>
                    <input type="text" class="form-control" id="BB_Ibu" name="BB_Ibu" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">IMT</label>
                    <input type="text" class="form-control" id="IMT" name="IMT" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Usia_ibu</label>
                    <input type="text" class="form-control" id="Usia_ibu" name="Usia_ibu" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Pendidikan_Ibu</label>
                    <input type="text" class="form-control" id="Pendidikan_Ibu" name="Pendidikan_Ibu" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Pekerjaan_ibu</label>
                    <input type="text" class="form-control" id="Pekerjaan_ibu" name="Pekerjaan_ibu" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Pendidikan_AYAH</label>
                    <input type="text" class="form-control" id="Pendidikan_AYAH" name="Pendidikan_AYAH" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Pekerjaan_Ayah</label>
                    <input type="text" class="form-control" id="Pekerjaan_Ayah" name="Pekerjaan_Ayah" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Jumlah_PendapatanKeluarga</label>
                    <input type="text" class="form-control" id="Jumlah_PendapatanKeluarga" name="Jumlah_PendapatanKeluarga" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">NominalGaji</label>
                    <input type="text" class="form-control" id="NominalGaji" name="NominalGaji" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Status_Pernikahan</label>
                    <input type="text" class="form-control" id="Status_Pernikahan" name="Status_Pernikahan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">UsiaPertamaMenikahIbu</label>
                    <input type="text" class="form-control" id="UsiaPertamaMenikahIbu" name="UsiaPertamaMenikahIbu" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Kepemilikan_KK</label>
                    <input type="text" class="form-control" id="Kepemilikan_KK" name="Kepemilikan_KK" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">JumlahAnak</label>
                    <input type="text" class="form-control" id="JumlahAnak" name="JumlahAnak" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Nama Baduta</label>
                    <input type="text" class="form-control" id="Nama_BADUTA" name="Nama_BADUTA" placeholder="Masukkan Nama Baduta">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Usia Baduta (Bulan)</label><span class="font-weight-bold text-danger"> * </span>
                    <input type="text" class="form-control" id="UsiaBaduta" name="UsiaBaduta" placeholder="Masukkan Usia Baduta">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Jenis Kelamin</label>
                    <select class="form-control" name="JenisKelamin" id="JenisKelamin">
                        <option disabled selected>Pilih...</option>
                        <option value="1">LAKI-LAKI</option>
                        <option value="2">PEREMPUAN</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">PersalinanOleh</label>
                    <input type="text" class="form-control" id="PersalinanOleh" name="PersalinanOleh" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">BB_Lahir</label>
                    <input type="text" class="form-control" id="BB_Lahir" name="BB_Lahir" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">PanjangLahir</label>
                    <input type="text" class="form-control" id="PanjangLahir" name="PanjangLahir" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Riwayat Imunisasi 2 Minggu Terakhir</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Riwayat_Imunisasi" id="Riwayat_Imunisasi">
                        <option disabled selected>Pilih...</option>
                        <option value="1">LENGKAP</option>
                        <option value="2">TIDAK LENGKAP</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Riwayat Diare 2 Minggu Terakhir</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="RiwayatDiare_2mgguTerakhir" id="RiwayatDiare_2mgguTerakhir">
                        <option disabled selected>Pilih...</option>
                        <option value="1">ADA</option>
                        <option value="2">TIDAK ADA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Riwayat ISPA 2 Minggu Terakhir</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="RiwayatISPA_2mgguTerakhir" id="RiwayatISPA_2mgguTerakhir">
                        <option disabled selected>Pilih...</option>
                        <option value="1">ADA</option>
                        <option value="2">TIDAK ADA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak Mempunyai Akte Kelahiran ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Punya_AkteLahir" id="Punya_AkteLahir">
                        <option disabled selected>Pilih...</option>
                        <option value="1">ADA</option>
                        <option value="2">TIDAK ADA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Berat Badan Baduta (kg)</label><span class="font-weight-bold text-danger"> * </span>
                    <input type="text" class="form-control" id="BB_Baduta" name="BB_Baduta" placeholder="Masukkan Berat Badan Baduta">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Panjang Badan Baduta</label><span class="font-weight-bold text-danger"> * </span>
                    <input type="text" class="form-control" id="PB_Baduta" name="PB_Baduta" placeholder="Masukkan Panjang Badan Baduta">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">StatusGizi_Baduta</label>
                    <input type="text" class="form-control" id="StatusGizi_Baduta" name="StatusGizi_Baduta" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak Mendapatkan ASI Ekslusif ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Baduta_Dapat_ASI_Ekslusif" id="Baduta_Dapat_ASI_Ekslusif">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak Mendapat MPASI yang sesuai ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Baduta_DapatMPASI" id="Baduta_DapatMPASI">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak Mendapat PMT (Pemberian Makanan Tambahan) ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Baduta_DapatPMT" id="Baduta_DapatPMT">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah PMT Dihabiskan ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="PMT_DihabiskanAtauTidak" id="PMT_DihabiskanAtauTidak">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">AlasanMendapat_PMT</label>
                    <input type="text" class="form-control" id="AlasanMendapat_PMT" name="AlasanMendapat_PMT" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak ditimbang di Posyandu Minimal 8x setahun ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="BadutaDitimbang_Minimal8x" id="BadutaDitimbang_Minimal8x">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak Mendapat tablet Zinc jika Diare ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Baduta_DapatZinc_saatDiare" id="Baduta_DapatZinc_saatDiare">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak Pernah Cacingan ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="PernahCacingan" id="PernahCacingan">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak Pernah Minum Obat Cacing ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="PernahMinum_ObatCacing" id="PernahMinum_ObatCacing">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu Saat Hamil Mendapat Folat Fe ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Bumil_DapatFolat_Fe" id="Bumil_DapatFolat_Fe">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu Mendapat Konseling dan Promosi ASI ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Ibu_DapatKonseling_PromosiASI" id="Ibu_DapatKonseling_PromosiASI">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu Mendapatkan Konseling dan Promosi MPASI ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Ibu_DapatKonseling_PromosiMPASI" id="Ibu_DapatKonseling_PromosiMPASI">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah di Rumah Mempunyai Saluran Air Bersih ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Punya_Sal_AirBersih" id="Punya_Sal_AirBersih">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Mempunyai Jamban di Rumah ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Punya_Jamban" id="Punya_Jamban">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Seluruh Anggota Keluarga Memakai Jamban di Rumah ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="GunainJamban_BAB" id="GunainJamban_BAB">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah di Rumah Ibu Mempunyai Septic Tank ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Ada_SepticTank" id="Ada_SepticTank">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu Selalu Mencuci Tangan Sebelum Makan dengan Sabun ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="IBU_CuciTanganSabun_SBLMMakan" id="IBU_CuciTanganSabun_SBLMMakan">
                        disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu Selalu Mencuci Tangan Setelah Buang Air Besar dengan Sabun ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="IBU_CuciTanganSabun_SetelahBAB" id="IBU_CuciTanganSabun_SetelahBAB">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak Selalu Mencuci Tangan Sebelum Makan dengan Sabun ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Anak_CuciTanganSabun_SebelumMakan" id="Anak_CuciTanganSabun_SebelumMakan">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak Selalu Mencuci Tangan Setelah Buang Air Besar dengan Sabun ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Anak_CuciTanganSabun_SetelahBAB" id="Anak_CuciTanganSabun_SetelahBAB">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Anak Selalu Menggunakan Alas Kaki Jika Keluar Rumah ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Anak_GunakanAlasKakiSaatMAin" id="Anak_GunakanAlasKakiSaatMAin">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu Mendapatkan Bantuan Berupa Beras ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Ibu_DapatBantuanBeras" id="Ibu_DapatBantuanBeras">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu dan Keluarga Selalu Mengkonsumsi Sayuran ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Kel_KonsumsiSayuran" id="Kel_KonsumsiSayuran">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu dan Keluarga Selalu Mengkonsumsi Buah-Buahan ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Kel_KonsumsiBuahBuahan" id="Kel_KonsumsiBuahBuahan">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ada Layanan Kesehatan di Wilayah Tempat Tinggal ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="AdaYAnKes_diRumahTinggal" id="AdaYAnKes_diRumahTinggal">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Bagaimana Cara Ibu Pergi Ke Puskesmas/Posyandu ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="CaraPergi_KePuskesmas" id="CaraPergi_KePuskesmas">
                        <option disabled selected>Pilih...</option>
                        <option value="1">KENDARAAN PRIBADI</option>
                        <option value="2">KENDARAAN UMUM</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">JarakRumahKeYANKES</label>
                    <input type="text" class="form-control" id="JarakRumahKeYANKES" name="JarakRumahKeYANKES" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu Memakai KB ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="IBU_PakaiKB" id="IBU_PakaiKB">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">JenisKB</label>
                    <input type="text" class="form-control" id="JenisKB" name="JenisKB" placeholder="">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu Mempunyai BPJS ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Kepemilikan_BPJS" id="Kepemilikan_BPJS">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Siapakah yang berkewajiban Mendidik Anak ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="KewajibanMendidikAnak" id="KewajibanMendidikAnak">
                        <option disabled selected>Pilih...</option>
                        <option value="1">IBU</option>
                        <option value="2">AYAH</option>
                        <option value="3">KAKEK</option>
                        <option value="4">NENEK</option>
                        <option value="5">OM</option>
                        <option value="6">TANTE</option>
                        <option value="7">ASISTEN RUMAH TANGGA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Siapakah yang Menjaga Anak Setiap Hari ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="YangJagaAnak_SetiapHari" id="YangJagaAnak_SetiapHari">
                        <option disabled selected>Pilih...</option>
                        <option value="1">IBU</option>
                        <option value="2">AYAH</option>
                        <option value="3">KAKEK</option>
                        <option value="4">NENEK</option>
                        <option value="5">OM</option>
                        <option value="6">TANTE</option>
                        <option value="7">ASISTEN RUMAH TANGGA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ada PAUD/TK di Sekitar Tempat Tinggal ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="PAUD_SekitarRumah" id="PAUD_SekitarRumah">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu Menyekolahkan Anak di PAUD/TK ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="IbuMenyekolahkanAnak_KePAUD" id="IbuMenyekolahkanAnak_KePAUD">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Apakah Ibu/Keluarga Ada yang Pernah Mendapatkan Informasi Tentang Gizi ?</label><span class="font-weight-bold text-danger"> * </span>
                    <select class="form-control" name="Ibu_DapatInformasi_Gizi" id="Ibu_DapatInformasi_Gizi">
                        <option disabled selected>Pilih...</option>
                        <option value="1">YA</option>
                        <option value="2">TIDAK</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="submit_prediction">Kalkulasi Prediksi</button>
            </form>
            <!-- Form Prediction End -->

            <!-- <small class="d-block text-right mt-3">
                <a href="#">Update Model</a>
            </small> -->
        </div>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- CanvasJS -->
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>