<!-- awal container -->
<div class="container">
<?php echo $this->session->flashdata('message'); ?>
	<!-- logika if untuk publish -->
	<?php if (count($details) == 0) { ?>
		<div class="mb-3">
			<a href="<?= base_url('angket/edit_angket'); ?>/<?= $detail_header['id_angket']; ?>">
				<button class="btn btn-success">Edit
					<span><i class="fas fa-fw fa-edit"></i></span>
				</button>
			</a>
			<a id="deleteAngket" href="#" data-toggle="modal" data-target="#hapusAngket" data-id="<?= $detail_header['id_angket']; ?>">
				<button class="btn btn-danger">Hapus
					<span><i class="fas fa-fw fa-trash-alt"></i></span>
				</button>
			</a>
		</div>
	<?php }else{ ?>
			<div class="mb-3">		
				<?php if ($detail_header['is_active'] == 1 && $detail_header['publish'] == 0) { ?>
					<a class="btn btn-primary" href="<?= base_url('angket/publish'); ?>/<?= $detail_header['id_angket']; ?>/Publish">
						<span>Publish <i class="fas fa-fw fa-upload"></i></span>
					</a>
					<a href="<?= base_url('angket/edit_angket'); ?>/<?= $detail_header['id_angket']; ?>">
						<button class="btn btn-success">Edit
							<span><i class="fas fa-fw fa-edit"></i></span>
						</button>
					</a>
					<a id="deleteAngket" href="#" data-toggle="modal" data-target="#hapusAngket" data-id="<?= $detail_header['id_angket']; ?>">
						<button class="btn btn-danger">Hapus
							<span><i class="fas fa-fw fa-trash-alt"></i></span>
						</button>
					</a>
					<p class="font-weight-bolder text-muted mt-3">
						<i class="fas fa-info-circle"></i> Disarankan untuk CEK ULANG ANGKET sebelum di PUBLISH !!!!
					</p>
				<?php }else{
					if ($detail_header['is_active'] == 1 && $detail_header['publish'] == 1) { ?>
						<a class="btn btn-danger" href="<?= base_url('angket/publish'); ?>/<?= $detail_header['id_angket']; ?>/Stop">
							<span>Stop <i class="fas fa-fw fa-stop-circle"></i></span>
						</a>
						<p class="font-weight-bolder text-muted mt-3">
							<i class="fas fa-info-circle"></i> Proses Survei Sedang Berlangsung
						</p>
				<?php }else{
						if ($detail_header['is_active'] == 0 && $detail_header['publish'] == 1) { ?>
							<p class="font-weight-bolder text-muted mt-3">
								<i class="fas fa-info-circle"></i> Proses Survei Sudah Selesai
							</p>
							<a id="deleteAngket" href="#" data-toggle="modal" data-target="#hapusAngket" data-id="<?= $detail_header['id_angket']; ?>">
								<button class="btn btn-danger">Hapus
									<span><i class="fas fa-fw fa-trash-alt"></i></span>
								</button>
							</a>
							<a id="ulangi" href="#" data-toggle="modal" data-target="#re-survei" data-id="<?= $detail_header['id_angket']; ?>">
								<button class="btn btn-secondary">Re - Survei
									<span><i class="fas fa-fw fa-redo-alt"></i></span>
								</button>
							</a>
					<?php }
					}
				} ?>
			</div>
	<?php } ?>
	<!-- selesai logika if -->
	

	<!-- tag awal nav bar untuk ratting scale dan grafik -->
	<ul class="nav nav-tabs mb-2">
	  <li class="nav-item">
	    <a class="nav-link active" target="_BLANK" href="<?= base_url('angket/cetak_nilai/'.$detail_header['id_angket']); ?>"><i class="fas fa-fw fa-balance-scale"></i> Laporan summary</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link active" href="<?= base_url('angket/grafik/'.$detail_header['id_angket']); ?>"><i class="fas fa-fw fa-chart-area"></i> Laporan Grafik</a>
	  </li>
	  <li class="nav-item">
	  	<a class="nav-link disabled" href="<?= base_url('angket/grafik/'.$detail_header['id_angket']); ?>"><label>Judul :</label> <?= $detail_header['judul']; ?>
	  	</a>
	  </li>
	  <li>
	  	<a class="nav-link disabled" href="<?= base_url('angket/grafik/'.$detail_header['id_angket']); ?>"><label>Share :</label> <?= $detail_header['share']; ?>
	  	</a>
	  </li>
	</ul>
	<!-- selesai tag nav bar ratting scale dan grafik -->

<!-- mulai row -->
<div class="row mb-2">
	<!-- mulai colom 1 -->
	<div class="col-sm-4">
		<!-- tag awal div card angket header -->
	<div class="card">
	  <div class="card-body">
				<!-- menampilkan tabel grade dan total nila serta jumlah responden yang berpartisipasi -->
				<h4>Summary</h4>
				<p>Responden : <strong><?= $total_responden; ?></strong></p>
				<p>Nilai : <strong><?= $total_nilai['total_nilai']; ?></strong></p>
	  				<table class="table table-striped">
						<thead>
							<th>Interval</th>
							<th>Grade</th>
							<th>Keterangan</th>
						</thead>
						<tbody>
						<?php
						$interval_puncak = $total_responden * $total_pertanyaan['jumlah_pertanyaan'] * 5;
						$panjang_interval = $interval_puncak / 5;
						$awal = 0;
						$akhir = 0;
						$grade_string = ['A','B','C','D','E'];
						$keterangan_string = ['Sangat Baik','Baik','Cukup Baik','Kurang Baik','Buruk'];

						for ($i=0; $i < 5; $i++) { 
						$interval_awal = $interval_puncak - $panjang_interval - $awal + 1;
						$interval_akhir = $interval_puncak - $akhir;
						?>
							<tr>
								<td><?= $interval_awal; ?> - <?= $interval_akhir; ?></td>
								<td><?= $grade_string[$i]; ?></td>
								<td><?= $keterangan_string[$i]; ?></td>
							</tr>
						<?php  
							$awal = $awal + $panjang_interval;
							$akhir = $akhir + $panjang_interval;
							}; 
						?>
							</tbody>
						</table>
					<!--selesai menampilkan tabel grade dan total nila serta jumlah responden yang berpartisipasi -->
	  </div>
	 <!-- penutup div card angket header -->
	</div>
	<!-- selesai kolom 1 -->
</div>

	<!-- mulai colom 2 -->
	<div class="col-sm-8">
		<!-- awal card 2-->
		<div class="card">
			<!-- card body -->
		  <div class="card-body">
		    	<!-- pertanyaan -->
	    <h3 class="card-title">
	    	Daftar Pertanyaan <i class="far fa-question-circle"></i> :
	    </h3>

	    <!-- pengulangan pertanyaan ( didalam pengulangan terdapat pengulangan interval) -->
	    <?php 
	    	$hitung = count($details); 
	    	$startpertanyaan = 0;
	    	$startinterval = 0;
	    	$stopinterval = 5;
	    	$startnamainterval = 0;

	    	// memulai pengulangan pertanyaan
	    	for($i=0;$i < $hitung ; $i++) : 
	    ?>
			<h4 class="card-subtitle mb-2 mt-5 text-muted">
				<i class="far fa-fw fa-list-alt"></i><?= $i+1; ?>
				<?= $details[$startpertanyaan]['pertanyaan'];  ?>
			</h4>
	    		

	    		<!-- perulangan interval -->
	    		<?php for ($interval = $startinterval; $interval < $stopinterval; $interval++) : ?>
	    			 <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input">
                              <label class="custom-control-label"><?= $detail_intervals[$startnamainterval]['nama_interval'] ?></label>
                            </div>
	    		<?php 
	    			$startnamainterval = $startnamainterval + 1;
	    			endfor;
	    		?>
	    		<!-- selesai pengulangan interval -->
	    		

	    <!-- selesai pengulangan pertanyaan -->
	    <?php 
	    	$startpertanyaan = $startpertanyaan + 1;
			endfor;
		 ?>
		    <!-- selesai card body -->
		  </div>
		  <!-- selesai card 2 -->
		</div>
	<!-- selesai kolom 2 -->
	</div>
	<!--  akhir row-->
</div>
	

<!-- penutup div container -->
</div>

<!-- dibuat oleh muhammad nur basari -->










