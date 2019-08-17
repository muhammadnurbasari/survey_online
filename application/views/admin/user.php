
        <!-- Begin Page Content -->
        <div class="container-fluid">
         
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
            <div class="row mb-3">
              <div class="col-md-6">
                <a href="<?= base_url('auth/registration');?>" class="btn btn-primary"><span><i class="fas fa-fw fa-user-plus"></i></span></a>    
              </div>  
            </div>

            <?= $this->session->flashdata('message'); ?>

          <table id="dtUser" class="table table-stripped">
            <thead>
              <th>NO</th>
              <th>NAME</th>
              <th>EMAIL</th>
              <th>ROLE</th>
              <th>KELOLA</th>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($users as $user) : 
              ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $user['name']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <?php if ($user['role_id'] == 1) { ?>
                    <td>Administrator</td> 
                    <?php }else{ ?>
                    <td>Surveyor</td>
                    <?php } ?>
                    <td>
                      <a href="<?= base_url('admin/edit_user');  ?>/<?= $user['surveyor_id'];  ?>">
                      <i class="fas fa-fw fa-edit"></i>
                      </a> ||
                      <a id="deleteUser" href="#" data-toggle="modal" data-target="#hapusUser" data-id="<?= $user['surveyor_id']; ?>" data-role="<?= $user['role_id']; ?>" data-name="<?= $user['name']; ?>">
                      <i class="fas fa-fw fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


 