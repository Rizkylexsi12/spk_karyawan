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
        <h3>Kriteria & Bobot</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <p class="card-text">Pengambil keputusan memberi bobot preferensi dari setiap kriteria dengan masing-masing jenisnya (Benefit atau Cost):</p>
                </div>
                <div class="ml-auto">
                  <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#inlineForm" style="margin-left: 20px;">
                    Tambah Kriteria & Bobot
                  </button>
                </div>
                <hr>
                <div class="table-responsive">
                  <table class="table table-striped mb-0" style="width: 1100px;margin-left: 30px;margin-right: 30px;">
                  <caption> Tabel Kriteria (C<sub>i</sub>) </caption>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Simbol</th>
                    <th class="text-center">Kriteria</th>
                    <th class="text-center">Bobot</th>
                    <th class="text-center">Atribut</th>
                    <th class="text-center">Action</th>
                  </tr>
                  <?php
                    $sql = 'SELECT id_criteria,criteria,weight,attribute FROM saw_criterias';
                    $result = $db->query($sql);
                    $i = 0;
                    while ($row = $result->fetch_object()) {
                        echo "<tr>
                            <td class='text-center'>" . (++$i) . "</td>
                            <td class='text-center'>C{$i}</td>
                            <td>{$row->criteria}</td>
                            <td class='text-center'>{$row->weight}</td>
                            <td class='text-center'>{$row->attribute}</td>
                            <td class='text-center'>
                              <div class='btn-group mb-1'>
                                <div class='dropdown text-center'>
                                    <button class='btn dropdown-toggle me-1 btn-sm' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='background-color: #169859;color: white;'>
                                      Aksi
                                    </button>
                                    <div class='dropdown-menu' aria-labelled by='dropdownMenuButton'>
                                      <a class='dropdown-item' href='bobot-edit.php?id={$row->id_criteria}'>Edit</a>
                                      <a class='dropdown-item' href='bobot-hapus.php?id={$row->id_criteria}'>Hapus</a>
                                    </div>
                                </div>
                              </div>
                            </td>
                          </tr>\n";
                    }
                    $result->free();
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
  <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Tambah Kriteria & Bobot </h4>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form action="bobot-simpan.php" method="POST">
          <div class="modal-body">
            <label>Kriteria : </label>
            <div class="form-group">
              <input type="text" name="kriteria" placeholder="Input Kriteria" class="form-control" required>
            </div>
          </div>
          <div class="modal-body">
            <label>Bobot : </label>
            <div class="form-group">
              <input type="number" name="bobot" placeholder="Input Bobot" class="form-control" required>
            </div>
          </div>
          <div class="modal-body">
            <label>Atribut : </label>
            <div class="form-group">
            <select class="form-control form-select" name="attribute">
              <option value="benefit">Benefit</option>
              <option value="cost">Cost</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="submit" name="submit" class="btn ml-1" style="background-color: #169859;color: white;">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Simpan</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php require "layout/js.php";?>
</body>
</html>