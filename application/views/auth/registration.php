
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-sm-8">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create Surveyor!</h1>
              </div>
              <?= $this->session->flashdata('message'); ?>
              <form class="user" method="POST" action="<?= base_url('auth/registration'); ?>">
                 <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="name" name="name" value="<?= set_value('name'); ?>" placeholder="Full Name">
                  <?= form_error('name','<small class="text-danger"><i>','</i></small>'); ?>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="email" name="email" value="<?= set_value('email'); ?>"" placeholder="Email Address">
                  <?= form_error('email','<small class="text-danger"><i>','</i></small>'); ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    <?= form_error('password','<small class="text-danger"><i>','</i></small>'); ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="passconf" name="passconf" placeholder="Confirm Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register
                </button>
              </form>
              <hr>
            </div>
          </div>
          <div class="col-sm-4"></div>
        </div>
