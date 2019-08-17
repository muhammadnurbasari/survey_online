

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-10">
        <?= $this->session->flashdata('message'); ?>
        <div class="card o-hidden border-0 shadow-lg my-3">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-3">
                  <div class="text-center">
                    <h1 class="h3 text-gray-900 mb-4">
                      <b class="text-primary"><strong>SURVEI</strong> <b class="text-secondary">ONLINE</b></b><br/>
                      <b class="text-secondary"><strong>Insan</strong> <b class="text-primary">Pembangunan</b></b>
                    </h1>
                  </div>
                  <hr>
                  <form method="post" action="<?= base_url('nilai/simpan_nilai'); ?>">
                    <!-- Get id angket  -->
                    <input type="hidden" name="id_angket" value="<?= $angkets[0]['id_angket']; ?>">
                    <!-- Get id_responden_mhs -->
                    <?php if ($this->session->userdata('nipd')): ?>
                      <input type="hidden" name="id_responden_mhs" value="<?= $this->session->userdata('nipd'); ?>">
                    <?php endif ?>
                    <!-- Get id_responden_dosen -->
                    <?php if ($this->session->userdata('nidn')): ?>
                      <input type="hidden" name="id_responden_dosen" value="<?= $this->session->userdata('nidn'); ?>">
                    <?php endif ?>

                    <!-- looping interval -->
                    <h2 class="card-title text-primary"><?= $angkets[0]['judul']; ?></h2>
                      <?php $nameInterval=1;$start=0; for ($pertanyaan=0; $pertanyaan < count($intervals)/5 ; $pertanyaan++) { ?>
                        <label>
                          <i class="far fa-fw fa-list-alt"></i><?= $pertanyaan+1; ?>.
                          <?= $intervals[$start]['pertanyaan'];  ?>
                        </label><br>
                          <?php $rolling = $start;$label =$start; for ($interval=0; $interval < 5 ; $interval++) { ?>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" value="<?= $interval+1; ?>" id="<?= $label ?>" name="<?= $nameInterval; ?>" class="custom-control-input" required/>
                              <label class="custom-control-label" for="<?= $label; ?>"><?= $intervals[$rolling]['nama_interval'] ?></label>
                            </div>
                          <?php $rolling = $rolling+1;$label = $label+1; } ?>    
                          <hr>
                      <?php $nameInterval=$nameInterval+1;$start=$start+5; } ?>
                    <button class="btn btn-block btn-primary" type="submit">SUBMIT</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
          <footer class="sticky-footer bg-white">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                 <span>Copyright &copy; STMIK IP 2019</span>
              </div>
            </div>
          </footer>
        </div>

      </div>

    </div>

  </div>

<!-- Logout ubah password-->
  <div class="modal fade" id="ubahPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Ubah Pasword</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="post" action="<?= base_url('auth/ubah_pass'); ?>">
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Password lama</span>
            </div>
            <input type="password" required name="passwordlama" class="form-control" aria-label="PasswordLama" aria-describedby="basic-addon1">
          </div> 
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Password baru</span>
            </div>
            <input type="password" required name="passwordbaru" class="form-control" aria-label="PasswordBaru" aria-describedby="basic-addon1">
          </div>  
           <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Konfirmasi</span>
            </div>
            <input type="password" required name="konfirmasi" class="form-control" aria-label="konfirmasi" aria-describedby="basic-addon1">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Ubah</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- dibuat oleh muhammad nur basari -->