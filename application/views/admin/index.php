
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?= $this->session->flashdata('message'); ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <!-- mulai row Pertama -->
          <div class="row">
            <!-- kolom surveyor -->
          	<div class="col-sm-4">
          			<div class="col-sm-6">
			          <div class="thumbnail mx-5">
			            <a href="<?= base_url('admin/data_user') ?>">
                    <span style="font-size: 80px; color: Dodgerblue;">
                      <i class="fas fa-users"></i>
                    </span>
                    <kbd>surveyor</kbd>
			            </a>
			          </div>
			        </div>
          	</div>
            <!-- selesai kolom surveyor -->
           
             <!-- kolom create angket -->
            <div class="col-sm-4">
                <div class="col-sm-6">
                <div class="thumbnail mx-3">
                  <a href="<?= base_url('user/create_angket') ?>">
                    <span style="font-size: 80px; color: Dodgerblue;">
                      <i class="fas fa-fw fa-calendar-plus"></i>
                    </span>
                    <kbd>create angket</kbd>
                  </a>
                </div>
              </div>
            </div>
            <!-- selesai kolom create angket -->

           <!-- kolom angket -->
            <div class="col-sm-4">
                <div class="col-sm-6">
                <div class="thumbnail mx-5">
                  <a href="<?= base_url('angket') ?>">
                    <span style="font-size: 80px; color: Dodgerblue;">
                      <i class="fas fa-fw fa-sticky-note"></i>
                    </span>
                    <kbd>angket</kbd>
                  </a>
                </div>
              </div>
            </div>
            <!-- selesai kolom angket -->
            

          </div>
          <!-- div penutup row pertama -->

        
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      