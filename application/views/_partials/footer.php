<!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; STMIK IP 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are You Sure?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
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


  <!-- Modal hapus User -->
<div class="modal fade" id="hapusUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="<?= base_url('admin/delete_user'); ?>">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yakin Hapus User ??</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="form-group">
           <input type="hidden" name="surveyor_id" class="form-control" id="id" >
           <input type="hidden" name="role" class="form-control" id="role" >
           <input type="hidden" name="name" class="form-control" id="name" >
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- selesai modal hapus user -->

<!-- modal hapus angket -->
<div class="modal fade" id="hapusAngket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="<?= base_url('angket/hapus_angket'); ?>">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yakin Hapus Angket ??</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="form-group">
           <input type="hidden" name="id_angket" class="form-control" id="idAngket" >
        </div>
      </div>
      <div class="modal-body">
        <p class="font-weight-bolder text-muted mt-3">
          <i class="fas fa-info-circle"></i>
          Seluruh data angket dan hasil survei dari responden akan dihapus, Sistem menyarankan untuk menyimpan / download file PDF sebagai backup
        </p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- selesai modal hapus angket -->

<!-- modal Re - Survei -->
<div class="modal fade" id="re-survei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="<?= base_url('angket/re_survei'); ?>">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yakin Re - Survei ??</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="form-group">
           <input type="hidden" name="id_angket" class="form-control" id="idA" >
        </div>
      </div>
      <div class="modal-body">
        <p class="font-weight-bolder text-muted mt-3">
          <i class="fas fa-info-circle"></i>
          Seluruh hasil survei dari responden akan dihapus, Sistem menyarankan untuk menyimpan / download file PDF sebagai backup
        </p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Re - Survei <i class="fas fa-fw fa-redo-alt"></i></button>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- selesai modal Re - Survei -->

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/jquery/jquery-3.3.1.js"></script>

  <!-- Core plugin datatables-->
  <script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script> 

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

  <!-- script grafik -->
  <script type="text/javascript" src="<?= base_url() ?>assets/vendor/chart.js/Chart.js"></script>

 <script type="text/javascript">
    $(document).ready(function() {
      $('#dtUser').DataTable();
    });
</script>

<!-- script get id untuk hapus user -->
 <script type="text/javascript">
    $(document).on("click","#deleteUser", function(){
      var id = $(this).data('id');
      var role = $(this).data('role');
      var name = $(this).data('name');
      $("#id").val(id);
      $("#role").val(role);
      $("#name").val(name);
    })

    $(document).on("click","#deleteAngket", function(){
      var id = $(this).data('id');
      $("#idAngket").val(id);
    })

     $(document).on("click","#ulangi", function(){
      var id = $(this).data('id');
      $("#idA").val(id);
    })

    $('.custom-file-input').on('change', function(){
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
    })

    
  </script>

  <!-- script add pertanyaan -->
  <!-- javascript -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#add").click(function(){
        var html = '';
          html += '<tr>';
          html += '<td><input type="text" name="item[question][]" class="form-control" placeholder="Input Pertanyaan . . ." required/><br/> ';
          html += '<input type="radio" class="ml-3" name="interval" value="1" disabled/><input type="text" name="item[option][]" class="sel_question form-control" placeholder="Option 1" required/><br/><input type="radio" class="ml-3" name="interval" value="2" disabled/><input type="text" name="item[option][]" class="sel_question form-control" placeholder="Option 2" required/><br/><input type="radio" class="ml-3" name="interval" value="3" disabled/><input type="text" name="item[option][]" class="sel_question form-control" placeholder="Option 3" required/><br/><input type="radio" class="ml-3" name="interval" value="4" disabled/><input type="text" name="item[option][]" class="sel_question form-control" placeholder="Option 4" required/><br/><input type="radio" class="ml-3" name="interval" value="5" disabled/><input type="text" name="item[option][]" class="sel_question form-control" placeholder="Option 5" required/></td>';
          html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span><i class="fas fa-trash-alt"></i></span></button></td></tr>';
      $('#item_table').append(html);
      });

    $("#addEdit").click(function(){
        var html = '';
          html += '<tr>';
          html += '<td><input type="text" name="item[question_baru][]" class="form-control" placeholder="Input Pertanyaan . . ." required/><br/> ';
          html += '<input type="radio" class="ml-3" name="interval" value="1" disabled/><input type="text" name="item[option_baru][]" class="sel_question form-control" placeholder="Option 1" required/><br/><input type="radio" class="ml-3" name="interval" value="2" disabled/><input type="text" name="item[option_baru][]" class="sel_question form-control" placeholder="Option 2" required/><br/><input type="radio" class="ml-3" name="interval" value="3" disabled/><input type="text" name="item[option_baru][]" class="sel_question form-control" placeholder="Option 3" required/><br/><input type="radio" class="ml-3" name="interval" value="4" disabled/><input type="text" name="item[option_baru][]" class="sel_question form-control" placeholder="Option 4" required/><br/><input type="radio" class="ml-3" name="interval" value="5" disabled/><input type="text" name="item[option_baru][]" class="sel_question form-control" placeholder="Option 5" required/></td>';
          html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span><i class="fas fa-trash-alt"></i></span></button></td></tr>';
      $('#item_table').append(html);
      });

    // delete list   
    $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
    });
  });
</script>

</body>

</html>