<div class="container">
  <div class="row mt-3">
    <div class="col-sm-8">
      <div class="card">
        <div class="card-header">
          <?= $title; ?>
        </div>
        <div class="card-body">
          <form method="post" action="<?= base_url('admin/update_user'); ?>">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id" placeholder="Masukkan id" name="id" value="<?= $details['surveyor_id']; ?>">
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" value="<?= $details['name']; ?>" required/>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Masukkan Email" name="email" value="<?= $details['email']; ?>" required/>
            <?= form_error('email','<small class="text-danger"><i>','</i></small>'); ?>
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <?php 
              $opt1 = "";
              $opt2 = "";

              if ($details['role_id'] == 1) {
               $opt1 = "selected";
              }else{
                $opt2 = "selected";
              };
             ?>
              <select class="custom-select custom-select-sm" name="role">
                <option disabled selected>-- Pilih --</option>
                <option value="1" <?= $opt1; ?> >Administrator</option>
                <option value="2" <?= $opt2; ?> >Surveyor</option>
              </select>
          </div>
          <div class="form-group">
            <label for="is active">Is Active</label>
            <?php 
              $opt1 = "";
              $opt2 = "";

              if ($details['is_active'] == 1) {
               $opt1 = "selected";
              }else{
                $opt2 = "selected";
              };
             ?>
              <select class="custom-select custom-select-sm" name="is_active">
                <option disabled selected>-- Pilih --</option>
                <option value="1" <?= $opt1; ?> >Aktif</option>
                <option value="0" <?= $opt2; ?> >Non aktif</option>
              </select>
          </div>
          <button type="submit" class="btn btn-primary btn-block">UPDATE</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-sm-4"></div>
  </div>
</div>   

