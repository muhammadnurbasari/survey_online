<!-- awal container -->
<div class="container mb-3">
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<?= $this->session->flashdata('message'); ?>

	<!-- jika belum ada angket yang dibuat -->
		<?php if (count($angkets) == 0): ?>
			<p class="font-weight-bolder text-danger"><i class="fas fa-info-circle"></i> BELUM ADA ANGKET</p>
	    	<p class="font-weight-bolder text-muted">SILAHKAN KLIK CREATE ANGKET !!!</p>
		<?php endif ?>
	
	

	<!-- awal tag row -->
	<div class="row">

		<?php $i = 0; foreach ($angkets as $angket) : ?>
			
			<!-- awal tag div kolom -->
			<div class="col-sm-4 mb-3 mt-3">
				<!-- awal tag div card -->
				<div class="card" style="width: 18rem;">
				  <div class="card-body">
				    <h4 class="card-title text-primary"><?= $angket['judul']; ?></h4>
				    <hr>
				    <h6 class="card-subtitle mt-4 text-muted"><i class="fas fa-fw fa-info-circle text-primary"></i> Tanggal dibuat :</h6>
				    <h6><i class="fas fa-fw fa-minus"></i> <?= $angket['tanggal']; ?></h6>

				    <!-- tampilkan created by dan update_by  -->
				    <?php 
				    	$created_by = "SELECT surveyor.name FROM angket LEFT JOIN surveyor ON angket.created_by = surveyor.surveyor_id ORDER BY angket.tanggal DESC";
				    	$created_by_exe = $this->db->query($created_by)->result_array();
				    	
				    	$update_by = "SELECT surveyor.name FROM angket LEFT JOIN surveyor ON angket.update_by = surveyor.surveyor_id ORDER BY angket.tanggal DESC";
				    	$update_by_exe = $this->db->query($update_by)->result_array();
				     ?>
				     <!-- menampilkan created -->
				     <?php if ($created_by_exe[$i]['name'] == NULL){ ?>
				     	<h6 class="card-subtitle mt-3 text-muted"><i class="fas fa-fw fa-info-circle text-primary"></i> Created By : Surveyor dihapus </h6>
				     <?php }else{ ?>
				     <h6 class="card-subtitle mt-3 text-muted"><i class="fas fa-fw fa-info-circle text-primary"></i> Created By :</h6>
				     <h6><i class="fas fa-fw fa-minus"></i> <?= $created_by_exe[$i]['name']; ?></h6>
				     <?php } ?>
				     <!-- selesai menampilkan created -->

				     <!-- menampilkan update by -->
				     <?php if ($update_by_exe[$i]['name'] == NULL){ ?>
				     	<h6 class="card-subtitle mt-3 text-muted"><i class="fas fa-fw fa-info-circle text-primary"></i> Update By :</h6>
				     	<h6><i class="fas fa-fw fa-minus"></i> <i>belum di update</i></h6>
				     <?php }else{ ?>
				     	<h6 class="card-subtitle mt-3 text-muted"><i class="fas fa-fw fa-info-circle text-primary"></i> Update By :</h6>
				     	<h6><i class="fas fa-fw fa-minus"></i> <?= $update_by_exe[$i]['name']; ?></h6>
				     <?php } ?>
				     <!-- selesai menampilkan update by -->
				     <!-- selesai tampilan created by dan upate by -->

				    <!-- status angket berdasarkan field is_active dan field publish -->
				    <?php if ($angket['is_active'] == 1 && $angket['publish'] == 0) {
				    	$status = "Belum publish<br/><small><i>note : cek ulang sebelum di publish</i></small>";
				    	$link_publish = "Publish";
				    	}else{
				    		if ($angket['is_active'] == 1 && $angket['publish'] == 1) {
				    			$status = "Survei Sedang Berlangsung";
				    			$link_publish = "Stop";
				    		}else{
				    			if ($angket['is_active'] == 0 && $angket['publish'] == 1) {
				    				$status = "Survei Sudah Selesai";
				    				$link_publish = "";
				    			}
				    		}
				    	}
				     ?>
				    <h6 class="card-subtitle mt-3 text-muted"><i class="fas fa-fw fa-info-circle text-primary"></i> Status :</h6>
				    <h6"><i class="fas fa-fw fa-minus"></i> <?= $status; ?></h6>
				    <!-- selesai proses menampilkan status -->

				    <!-- line divier -->
				    <hr class="sidebar-divider">

				    <a href="<?= base_url('angket/viewAngket'); ?>/<?= $angket['id_angket']; ?>" class="card-link btn btn-primary">View</a>
				    
				  </div>
				 <!-- penutup tag div card -->
				</div>
			<!-- penutup div kolom -->
			</div>
		<?php $i= $i+1; endforeach; ?>
	<!-- penutup Div row -->
	</div>


<!-- penutup div container -->
</div>

<!-- dibuat oleh muhammad nur basari