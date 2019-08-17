

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-5">

        <div class="card o-hidden border-0 shadow-lg my-3">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-3">
                  <div class="text-center">
                    <img width="150px" src="<?= base_url('assets/img/LOGO BARU STMIK Insan P.png') ;?>" class="img-fluid rounded" alt="...">
                  </div>
                  <div class="text-center">
                    <h1 class="h3 text-gray-900 mb-4">
                      <b class="text-primary"><strong>STMIK</strong></b><br/>
                      <b class="text-secondary"><strong>Insan Pembangunan</strong></b>
                    </h1>
                  </div>
                  <hr>
                  <?= $this->session->flashdata('message'); ?>
                  <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="email" name="email" maxlength="50" placeholder="Email..." value="<?= set_value('email'); ?>">
                      <?= form_error('email','<small class="text-danger"><i>','</i></small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password...">
                      <?= form_error('password','<small class="text-danger"><i>','</i></small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
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

