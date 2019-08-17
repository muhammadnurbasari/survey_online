<!-- mulai container -->
<div class="container">
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <?= $this->session->flashdata('message'); ?>

  <!-- jika semua pertanyaan terhapus -->
  <?php if (count($details) == 0) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      Anda Telah Menghapus Semua Pertanyaan <strong>Silahkan Isi Pertanyaan</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php } ?>
  <!-- selesai jika pertanyaan terhapus -->


  <!-- memulai tag card -->
      <div class="card">
        <div class="card-body">
          <form method="post" action="<?= base_url('angket/update_angket'); ?>">

            <!-- get id_angket -->
              <input type="hidden" class="form-control" id="id_angket" name="id_angket" value="<?= $detail_header['id_angket']; ?>" required/>
            <!-- selesai get id_angket -->
            
          <div class="form-group">
            <b>
            <label for="judul_angket">Tanggal :</label>
            <label for="judul_angket"><?= date('d F Y') ?></label>
            </b>
          </div>
            <div class="form-group">
              <label for="judul_angket">Judul Angket :</label>
              <input type="text" class="form-control" id="judul_angket" name="judul_angket" value="<?= $detail_header['judul'] ?>" required/>
            </div>
          
          <div class="form-group">
            <label for="share">Share:</label>
            <select name="share" class="form-control" required/>

            <!-- logika untuk menampilkan combo box dari file yang di get -->
            <?php 
            $opt1 = "";
            $opt2 = "";
            $opt3 = "";

            if ($detail_header['share'] === "Mahasiswa") {
              $opt1 = "selected";
            }else{
              if ($detail_header['share'] === "Dosen") {
                $opt2 = "selected";
              }else{
                 if ($detail_header['share'] === "Public") {
                  $opt3 = "selected";
                }
              }
            }
             ?>
             <!-- selesai logika menampilkan combo box dari file yang di get -->

              <option value="" disabled selected/>--Pilih Salah Satu--</option>
              <option value="Mahasiswa" <?= $opt1; ?>>Mahasiswa</option>
              <option value="Dosen" <?= $opt2; ?>>Dosen</option>
              <option value="Public" <?= $opt3; ?>>Public</option>
            </select>
          </div>
          <hr class="sidebar-divider">
          <div class="form-group">
            <table class="table table-bordered">
              <thead class="thead-dark">
                <th>Question & Option ( Edit Pertanyaan )</th>
                <th>Batal</th>
              </thead>
              <tbody id="item_table">
                 <!-- pengulangan pertanyaan ( didalam pengulangan terdapat pengulangan interval ) -->
                    <?php 
                      $hitung = count($details); 
                      $startpertanyaan = 0;
                      $startinterval = 0;
                      $stopinterval = 5;
                      $startnamainterval = 0;

                      // memulai pengulangan pertanyaan
                      for($i=0;$i < $hitung ; $i++) : 
                    ?>
                    <tr>
                      <td>
                        <!-- mengambil id_pertanyaan -->
                        <input type="hidden" name="item[question_id][]" class="form-control" placeholder="Input Pertanyaan . . ." value="<?= $details[$startpertanyaan]['id_pertanyaan']; ?>" required/>
                        <!-- selesai mengambil id_pertanyaan -->
                        <input type="text" name="item[question][]" class="form-control" placeholder="Input Pertanyaan . . ." value="<?= $details[$startpertanyaan]['pertanyaan']; ?>" required/>
                        <br/>
                        

                        <!-- perulangan interval -->
                        <?php for ($interval = $startinterval; $interval < $stopinterval; $interval++) : ?>
                         <input type="radio" class="ml-3" name="interval" value="<?= $startnamainterval ?>" disabled/>
                          <input type="text" name="item[option][]" class="sel_question form-control" placeholder="Option 1" value="<?= $detail_intervals[$startnamainterval]['nama_interval']; ?>" required/>
                          <!-- mengambil id_interval -->
                          <input type="hidden" name="item[option_id][]" class="sel_question form-control" placeholder="Option 1" value="<?= $detail_intervals[$startnamainterval]['id_interval']; ?>" required/>
                          <!-- mengambil id_interval -->
                          <br/>
                        <?php 
                          $startnamainterval = $startnamainterval + 1;
                          endfor;
                        ?>
                        <!-- selesai pengulangan interval -->
                        

                    
                      </td>
                      <td>
                        <a href="<?= base_url('angket/hapus_pertanyaan/'.$details[$startpertanyaan]['id_pertanyaan']); ?>/<?= $details[0]['id_angket']; ?>">
                          <button type="button" name="remove" class="btn btn-danger btn-sm remove">
                            <span><i class="fas fa-trash-alt"></i></span>
                          </button>
                        </a>
                      </td>
                    </tr>
                    <!-- selesai pengulangan pertanyaan -->
                    <?php $startpertanyaan = $startpertanyaan + 1; ?>
                    <?php endfor; ?>
                
              </tbody>
            </table>
            <button class="btn btn-default" type="button" name="addEdit" id="addEdit"><span><i class="fas fa-edit"></i></span>Add Questions</button>
            <hr class="sidebar-divider">
          </div>
          <button type="submit" class="mt-3 btn btn-success btn-block">update angket</button>
        </form>
        </div>

        <!-- selesai tag card -->
      </div>
      <!-- selesai tag div container -->
</div>   

<!-- dibuat oleh muhammad nur basari