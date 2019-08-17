

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-12">

        <div class="card o-hidden border-0 shadow-lg my-3">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-3">
                  <div class="text-center mx-auto">
                    <h1 class="h3 text-gray-900 mb-4">
                      <b class="text-primary"><strong>SURVEI</strong> <b class="text-secondary">ONLINE</b></b><br/>
                      <b class="text-primary"><strong><?= $title; ?></strong></b><br>
                      <b class="text-secondary"><strong><?= $judul['judul']; ?></strong></b>
                    </h1>
                  </div>
                  <div class="text-left">
                    <a href="<?= base_url('angket/viewAngket/'.$judul['id_angket']); ?>" class="btn btn-secondary"><i class="fas fa-fw fa-chevron-circle-left"></i> Back</a>
                  </div>
                  <hr>
                  <!-- content -->
                  <div>
                    <canvas id="myChart"></canvas>
                  </div>
                  
                  <!-- selesai content -->

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
                  
<!-- dibuat oleh muhammad nur basari -->
