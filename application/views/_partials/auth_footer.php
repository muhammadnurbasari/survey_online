
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

<script type="text/javascript" src="<?= base_url() ?>assets/vendor/chart.js/Chart.js"></script>

<script>
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
	type: 'bar',
	data: {
	labels: [
	<?php for ($i=1; $i <= count($daftar_pertanyaan) ; $i++) { ?>
		'<?= "pertanyaan ".$i; ?>',
	<?php } ?>
	],
	datasets: [{
	  label: 'Total Nilai',
	  data: [
	  <?php for ($i=0; $i < count($daftar_nilai); $i++) { 
	  	echo $daftar_nilai[$i];
	  	echo ",";
	  } ?>
	  ],
	  backgroundColor: [
	  'rgba(255, 99, 132, 0.2)',
	  'rgba(54, 162, 235, 0.2)',
	  'rgba(255, 206, 86, 0.2)',
	  'rgba(75, 192, 192, 0.2)',
	  'rgba(255, 99, 132, 0.2)',
	  'rgba(54, 162, 235, 0.2)',
	  'rgba(255, 206, 86, 0.2)',
	  'rgba(75, 192, 192, 0.2)',
	  'rgba(255, 99, 132, 0.2)',
	  'rgba(54, 162, 235, 0.2)',
	  'rgba(255, 206, 86, 0.2)',
	  'rgba(75, 192, 192, 0.2)'
	  ],
	  borderColor: [
	  'rgba(255,99,132,1)',
	  'rgba(54, 162, 235, 1)',
	  'rgba(255, 206, 86, 1)',
	  'rgba(75, 192, 192, 1)',
	   'rgba(255,99,132,1)',
	  'rgba(54, 162, 235, 1)',
	  'rgba(255, 206, 86, 1)',
	  'rgba(75, 192, 192, 1)',
	   'rgba(255,99,132,1)',
	  'rgba(54, 162, 235, 1)',
	  'rgba(255, 206, 86, 1)',
	  'rgba(75, 192, 192, 1)'
	  ],
	  borderWidth: 5
	}]
	},
	options: {
	scales: {
	  yAxes: [{
	    ticks: {
	      beginAtZero:true
	    }
	  }]
	}
	}
	});
</script>
</body>

</html>