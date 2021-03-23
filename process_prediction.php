<?php
require_once __DIR__ . '\vendor\autoload.php';

// For Read CSV file
use Phpml\Dataset\CsvDataset;
// Function for splitting data into Train and Test data
use Phpml\CrossValidation\StratifiedRandomSplit;
// Function for Imputation Dataset
use Phpml\Preprocessing\Imputer;
use Phpml\Preprocessing\Imputer\Strategy\MeanStrategy;
// Function for Training the model
use Phpml\Classification\KNearestNeighbors;
// Function for checking our model is good or not
use Phpml\Metric\ConfusionMatrix;
use Phpml\Metric\ClassificationReport;
use Phpml\Metric\Accuracy;

// Read File
$dataset = new CsvDataset('Dataset_Final_Baru.csv', 67, true);

// Remove specific columns
$dataset->removeColumns([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 21, 22, 23, 24, 31, 36, 58, 60]);

// Splitting Data
$dataset = new StratifiedRandomSplit($dataset, 0.2);
$xTrainData = $dataset->getTrainSamples();
$yTrainData = $dataset->getTrainLabels();
$xTestData = $dataset->getTestSamples();
$yTestData = $dataset->getTestLabels();

// Change Data Number into Real
function change_real_value($xData)
{
    for ($i = 0; $i < count($xData); $i++) {
        for ($j = 0; $j < count($xData[$i]); $j++) {
            if ($j == 5 || $j == 6) {
                $xData[$i][$j] = floatval($xData[$i][$j]);
            } else {
                $xData[$i][$j] = intval($xData[$i][$j]);
            }
        }
    }
    return $xData;
}
$xTrainData = change_real_value($xTrainData);
$xTestData = change_real_value($xTestData);

// Imputation Null Data
$imputer = new Imputer(null, new MeanStrategy(), Imputer::AXIS_COLUMN);
$imputer->fit($xTrainData);
$imputer->transform($xTrainData);

// Training Model
$model = new KNearestNeighbors($k = 10);
$model->train($xTrainData, $yTrainData);

// Calculate Model Score
$prediction = [];
for ($i = 0; $i < count($xTestData); $i++) {
    $prediction[$i] = $model->predict($xTestData[$i]);
}

$numberAccuracy = Accuracy::score($yTestData, $prediction);
// echo print_r(ConfusionMatrix::compute($yTestData, $prediction));

$report = new ClassificationReport($yTestData, $prediction);
$tested_dataset = $report->getAverage();
$numberPrecision = $tested_dataset["precision"];
$numberRecall = $tested_dataset["recall"];
$numberF1Score = $tested_dataset["f1score"];

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form was submitted
    if (isset($_POST['submit_prediction'])) {
        $new_prediction = array(
            // $_POST['Nama_Ibu'],	
            // $_POST['Alamat'],
            // $_POST['Kecamatan'],
            // $_POST['Desa'],
            // $_POST['Nomer_NIK'],
            // $_POST['TB_Ibu'],
            // $_POST['BB_Ibu'],
            // $_POST['IMT'],
            // $_POST['Usia_ibu'],
            // $_POST['Pendidikan_Ibu'],
            // $_POST['Pekerjaan_ibu'],
            // $_POST['Pendidikan_AYAH'],
            // $_POST['Pekerjaan_Ayah'],
            // $_POST['Jumlah_PendapatanKeluarga'],
            // $_POST['NominalGaji'],
            // $_POST['Status_Pernikahan'],
            // $_POST['UsiaPertamaMenikahIbu'],
            // $_POST['Kepemilikan_KK'],
            // $_POST['JumlahAnak'],
            // $_POST['Nama_BADUTA'],
            $_POST['UsiaBaduta'],
            // $_POST['JenisKelamin'],
            // $_POST['PersalinanOleh'],	
            // $_POST['BB_Lahir'],
            // $_POST['PanjangLahir'],
            $_POST['Riwayat_Imunisasi'],
            $_POST['RiwayatDiare_2mgguTerakhir'],
            $_POST['RiwayatISPA_2mgguTerakhir'],
            $_POST['Punya_AkteLahir'],
            $_POST['BB_Baduta'],
            $_POST['PB_Baduta'],
            // $_POST['StatusGizi_Baduta'],	
            $_POST['Baduta_Dapat_ASI_Ekslusif'],
            $_POST['Baduta_DapatMPASI'],
            $_POST['Baduta_DapatPMT'],
            $_POST['PMT_DihabiskanAtauTidak'],
            // $_POST['AlasanMendapat_PMT'],	
            $_POST['BadutaDitimbang_Minimal8x'],
            $_POST['Baduta_DapatZinc_saatDiare'],
            $_POST['PernahCacingan'],
            $_POST['PernahMinum_ObatCacing'],
            $_POST['Bumil_DapatFolat_Fe'],
            $_POST['Ibu_DapatKonseling_PromosiASI'],
            $_POST['Ibu_DapatKonseling_PromosiMPASI'],
            $_POST['Punya_Sal_AirBersih'],
            $_POST['Punya_Jamban'],
            $_POST['GunainJamban_BAB'],
            $_POST['Ada_SepticTank'],
            $_POST['IBU_CuciTanganSabun_SBLMMakan'],
            $_POST['IBU_CuciTanganSabun_SetelahBAB'],
            $_POST['Anak_CuciTanganSabun_SebelumMakan'],
            $_POST['Anak_CuciTanganSabun_SetelahBAB'],
            $_POST['Anak_GunakanAlasKakiSaatMAin'],
            $_POST['Ibu_DapatBantuanBeras'],
            $_POST['Kel_KonsumsiSayuran'],
            $_POST['Kel_KonsumsiBuahBuahan'],
            $_POST['AdaYAnKes_diRumahTinggal'],
            $_POST['CaraPergi_KePuskesmas'],
            // $_POST['JarakRumahKeYANKES'],	
            $_POST['IBU_PakaiKB'],
            // $_POST['JenisKB'],	
            $_POST['Kepemilikan_BPJS'],
            $_POST['KewajibanMendidikAnak'],
            $_POST['YangJagaAnak_SetiapHari'],
            $_POST['PAUD_SekitarRumah'],
            $_POST['IbuMenyekolahkanAnak_KePAUD'],
            $_POST['Ibu_DapatInformasi_Gizi']
        );
        $prediction_new_input = $model->predict($new_prediction);
        $message = $prediction_new_input;
    } else {
        $message = "";
    }
}
