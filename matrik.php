<!DOCTYPE html>
<html lang="en">
  <?php
require "layout/head.php";
require "include/conn.php";
?>

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
          <h3>Matrik</h3>
        </div>
        <div class="page-content">
          <section class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h2 class="text-center">Matriks Keputusan (X) &amp; Ternormalisasi (R)</h2>
                </div>
                <div class="card-content">
                  <div class="card-body pt-1">
                    <p class="card-text">Melakukan perhitungan normalisasi untuk mendapatkan matriks nilai ternormalisasi (R), dengan ketentuan :
										Untuk normalisai nilai, jika faktor/attribute kriteria bertipe cost maka digunakan rumusan:
										Rij = ( min{Xij} / Xij) sedangkan jika faktor/attribute kriteria bertipe benefit maka digunakan rumusan:
										Rij = ( Xij/max{Xij} )
										</p>
										Nilai Kriteria & Bobot:
										</p>
										1. Kinerja (30%)
										   - Sangat Baik (4)
										   - Baik (3)
										   - Cukup (2)
										   - Buruk (1)
										</p>
										2. Kerja Sama (25%)
										   - Sangat Baik (4)
										   - Baik (3)
										   - Cukup (2)
										   - Buruk (1)
										</p>
										3. Kreatifitas (20%)
										   - Sangat Baik (4)
										   - Baik (3)
										   - Cukup (2)
										   - Buruk (1)
										</p>
										4. Keterampilan (15%)
										   - Sangat Baik (4)
										   - Baik (3)
										   - Cukup (2)
										   - Buruk (1)
										</p>
										5. Tanggung Jawab (10%)
										   - Sangat Baik (4)
										   - Baik (3)
										   - Cukup (2)
										   - Buruk (1)
										</p>
                  </div>
                  <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#inlineForm" style="margin-left: 20px;">
                    Isi Nilai Alternatif
                  </button>
                  <hr>
                  <div class="table-responsive">
                  <table class="table table-striped mb-0" style="width: 1100px;margin-left: 30px;margin-right: 30px;">
    <caption>
        Matrik Keputusan (X)
    </caption>
    <tr>
        <th rowspan='2' class="text-center">Alternatif</th>
        <th colspan='6' class="text-center">Kriteria</th>
    </tr>
    <tr>
        <th class="text-center">C1</th>
        <th class="text-center">C2</th>
        <th class="text-center">C3</th>
        <th class="text-center">C4</th>
        <th class="text-center">C5</th>
        <th class="text-center">Action</th>
    </tr>
    <?php
$sql = "SELECT
          a.id_alternative,
          b.name,
          SUM(IF(a.id_criteria=1,a.value,0)) AS C1,
          SUM(IF(a.id_criteria=2,a.value,0)) AS C2,
          SUM(IF(a.id_criteria=3,a.value,0)) AS C3,
          SUM(IF(a.id_criteria=4,a.value,0)) AS C4,
          SUM(IF(a.id_criteria=5,a.value,0)) AS C5
        FROM
          saw_evaluations a
          JOIN saw_alternatives b USING(id_alternative)
        GROUP BY a.id_alternative
        ORDER BY a.id_alternative";
$result = $db->query($sql);
$X = array(1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array());
while ($row = $result->fetch_object()) {
    array_push($X[1], round($row->C1, 2));
    array_push($X[2], round($row->C2, 2));
    array_push($X[3], round($row->C3, 2));
    array_push($X[4], round($row->C4, 2));
    array_push($X[5], round($row->C5, 2));
    echo "<tr class='center'>
            <th>A<sub>{$row->id_alternative}</sub> {$row->name}</th>
            <td class='text-center'>" . round($row->C1, 2) . "</td>
            <td class='text-center'>" . round($row->C2, 2) . "</td>
            <td class='text-center'>" . round($row->C3, 2) . "</td>
            <td class='text-center'>" . round($row->C4, 2) . "</td>
            <td class='text-center'>" . round($row->C5, 2) . "</td>
            <td class='text-center'>
              <a href='keputusan-hapus.php?id={$row->id_alternative}' class='btn btn-danger btn-sm'>Hapus</a>
            </td>
          </tr>\n";
}
$result->free();

?>
</table>
<hr>
<table class="table table-striped mb-0" style="width: 1100px;margin-left: 30px;margin-right: 30px;">
    <caption>
        Matrik Ternormalisasi (R)
    </caption>
    <tr>
        <th rowspan='2' class="text-center">Alternatif</th>
        <th colspan='5' class="text-center">Kriteria</th>
    </tr>
    <tr>
        <th class="text-center">C1</th>
        <th class="text-center">C2</th>
        <th class="text-center">C3</th>
        <th class="text-center">C4</th>
        <th class="text-center">C5</th>
    </tr>
    <?php
$sql = "SELECT
          a.id_alternative,
          SUM(
            IF(
              a.id_criteria=1,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[1]) . ",
                " . min($X[1]) . "/a.value)
              ,0)
              ) AS C1,
          SUM(
            IF(
              a.id_criteria=2,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[2]) . ",
                " . min($X[2]) . "/a.value)
               ,0)
             ) AS C2,
          SUM(
            IF(
              a.id_criteria=3,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[3]) . ",
                " . min($X[3]) . "/a.value)
               ,0)
             ) AS C3,
          SUM(
            IF(
              a.id_criteria=4,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[4]) . ",
                " . min($X[4]) . "/a.value)
               ,0)
             ) AS C4,
          SUM(
            IF(
              a.id_criteria=5,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[5]) . ",
                " . min($X[5]) . "/a.value)
               ,0)
             ) AS C5
        FROM
          saw_evaluations a
          JOIN saw_criterias b USING(id_criteria)
        GROUP BY a.id_alternative
        ORDER BY a.id_alternative
       ";
$result = $db->query($sql);
$R = array();
while ($row = $result->fetch_object()) {
    $R[$row->id_alternative] = array($row->C1, $row->C2, $row->C3, $row->C4, $row->C5);
    echo "<tr class='center'>
            <th class='text-center'>A{$row->id_alternative}</th>
            <td class='text-center'>" . round($row->C1, 2) . "</td>
            <td class='text-center'>" . round($row->C2, 2) . "</td>
            <td class='text-center'>" . round($row->C3, 2) . "</td>
            <td class='text-center'>" . round($row->C4, 2) . "</td>
            <td class='text-center'>" . round($row->C5, 2) . "</td>
          </tr>\n";
}
?>
</table>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <?php require "layout/footer.php";?>
      </div>
    </div>

    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Isi Nilai Alternatif </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="matrik-simpan.php" method="POST">
                        <div class="modal-body">
                            <label>Nama : </label>
                            <div class="form-group">
                              <select class="form-control form-select" name="id_alternative">
                                <?php
$sql = 'SELECT id_alternative,name FROM saw_alternatives';
$result = $db->query($sql);
$i = 0;
while ($row = $result->fetch_object()) {
    echo '<option value="' . $row->id_alternative . '">' . $row->name . '</option>';
}
$result->free();
?>
                              </select>
                            </div>
                        </div>
                        <div class="modal-body">
                            <label>Kriteria : </label>
                            <div class="form-group">
                            <select class="form-control form-select" name="id_criteria">
                            <?php
$sql = 'SELECT * FROM saw_criterias';
$result = $db->query($sql);
$i = 0;
while ($row = $result->fetch_object()) {
    echo '<option value="' . $row->id_criteria . '">' . $row->criteria . '</option>';
}
$result->free();
?>
                                          </select>
                            </div>
                        </div>
                        <div class="modal-body">
                            <label>Nilai : </label>
                            <div class="form-group">
                                <input type="number" name="value" placeholder="Input Nilai" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" name="submit" class="btn btn-primary ml-1" style="background-color: #169859;color: white;">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php require "layout/js.php";?>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    var inputNilai = document.querySelector('input[name="value"]');
    
    inputNilai.addEventListener('blur', function() {
      var nilai = parseInt(inputNilai.value);
      
      if (isNaN(nilai) || nilai < 1 || nilai > 4) {
        alert('Inputkan nilai dengan range 1 - 4');
      }
    });
  });
</script>

  </body>
</html>