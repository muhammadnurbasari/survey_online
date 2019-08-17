
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="card mb-3" style="max-width: 540px;">
            <?= $this->session->flashdata('message'); ?>
          <div class="row no-gutters">
            <div class="col-md-6">
              <ul class="navbar-nav bg-gradient" id="accordionSidebar">
                <!-- change Photo -->
                <form method="post" action="<?= base_url('user/update_photo'); ?>" enctype="multipart/form-data">
                  <li class="nav-item">
                      <img src="<?= base_url('assets/img/') .$user['image']; ?>" class="card-img mt-1 ml-1 rounded-sm">
                        <div class="custom-file ml-1 mt-0">
                          <input type="file" class="custom-file-input" id="customFile" name="image">
                          <label class="custom-file-label" for="customFile"><i class="fas fa-fw fa-portrait"></i>Choose file</label>
                        </div>
                        <button class="btn btn-primary mt-2 mb-2 ml-1 btn-block" type="submit">Change Photo</button>
                  </li>
                </form>
              </ul>
            </div>
            <div class="col-md-6">
              <div class="card-body">
                <h5 class="card-title"><?= $role['role']; ?></h5>
                <p class="card-text"><?= $user['email']; ?></p>
                <p class="card-text"><small class="text-muted">Created Since <?= $user['created_date']; ?></small></p>
              </div>
            </div>
          </div>
        </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      