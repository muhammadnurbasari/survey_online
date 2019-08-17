<!-- mulai container -->
<div class="container">
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <!-- memulai tag card -->
    <?= $this->session->flashdata('message'); ?>
      <div class="card">
        <div class="card-body">
          <form method="post" action="<?= base_url('angket/save_angket'); ?>">
          <div class="form-group">
            <b>
            <label for="judul_angket">Tanggal :</label>
            <label for="judul_angket"><?= date('d F Y') ?></label>
            </b>
          </div>
          <div class="form-group">
            <label for="judul_angket">Judul Angket :</label>
            <input type="text" class="form-control" id="judul_angket" name="judul_angket" required/>
          </div>
          <div class="form-group">
            <label for="share">Share:</label>
            <select name="share" class="form-control" required/>
              <option value="" disabled selected/>--Pilih Salah Satu--</option>
              <option value="Mahasiswa">Mahasiswa</option>
              <option value="Dosen">Dosen</option>
              <option value="Public">Public</option>
            </select>
          </div>
          <hr class="sidebar-divider">
          <div class="form-group">
            <table class="table table-bordered">
              <thead class="thead-dark">
                <th>Question & Option</th>
                <th>Batal</th>
              </thead>
              <tbody id="item_table"></tbody>
            </table>
            <button class="btn btn-default" type="button" name="add" id="add"><span><i class="fas fa-edit"></i></span>Add Questions</button>
            <hr class="sidebar-divider">
          </div>
          <button type="submit" class="mt-3 btn btn-primary btn-block">save angket</button>
        </form>
        </div>

        <!-- selesai tag card -->
      </div>
      <!-- selesai tag div container -->
</div>   

