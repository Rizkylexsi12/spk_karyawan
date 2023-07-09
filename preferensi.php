<!DOCTYPE html>
<html lang="en">
  <?php
    require "layout/head.php";
    require "include/conn.php";
    require "W.php";
    require "R.php";
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
          <h3>Nilai Preferensi (P)</h3>
        </div>
        <div class="page-content">
          <section class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <p class="card-text">
                    Nilai preferensi (P) merupakan penjumlahan dari perkalian matriks ternormalisasi (R) dengan vektor bobot (W).</p>
                  </div>
                  <div class="table-responsive">
                    <table id="nilai-table" class="table table-striped mb-0" style="width: 1100px;margin-left: 30px;margin-right: 30px;">
                    <caption>
                      Nilai Preferensi (P)
                    </caption>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Alternatif</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">Hasil</th>
                    </tr>
                    <?php
                      $P = array();
                      $m = count($W);
                      $no = 0;
                      foreach ($R as $i => $r) {
                          for ($j = 0; $j < $m; $j++) {
                            $P[$i] = (isset($P[$i]) ? $P[$i] : 0) + $r[$j] * $W[$j];
                          }
                          $sql = "SELECT name FROM saw_alternatives WHERE id_alternative = $i";
                          $result = $db->query($sql);
                          $row = $result->fetch_object();
                          echo "<tr class='center'>
                                  <td class='text-center'>" . (++$no) . "</td>
                                  <td class='text-center'>A{$i}</td>
                                  <td class='text-center'>{$row->name}</td>
                                  <td class='text-center nilai'><b>{$P[$i]}</b></td>
                                </tr>";
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
    <?php require "layout/js.php";?> 
  </body>
</html>
