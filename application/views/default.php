<!DOCTYPE html>
<html>
	<head>
		<title> Aplikasi Inventaris </title>
		<link rel="stylesheet" 
			  href="<?php echo base_url ('/asset/vendor/css/bootstrap.min.css'); ?>"/>
	</head>
	<body>
		<div class="container">
			<div class="jumbotron jumbotron-fluid text-center">
				<div class="container">
					<h1>Aplikasi Inventaris</h1>
					<p class="lead">
						Untuk memenuhi tugas akhir RPL
					</p>
				</div>
				<?php echo anchor('LoginController/destroy', 'Logout') ?>
			</div>

			<div class="row">
				<div class="col-3">
					<div class="card">
						<div class="card-header text-center">MENU</div>
						<div class="card-body">
							<ul>
								<li>
									<?php 
										/** call controller here */
										echo anchor ('dashboard', 'Dashboard');
									?>
								</li>
							</ul>
							<ul>
								<li><?php echo anchor ('inventaris', 'Inventaris');?></li>
									<ul>
										<li><?php echo anchor ('jenis', 'Jenis Barang');?></li>
										<li><?php echo anchor ('ruang', 'Ruangan');?></li>
									</ul>
							</ul>

							<ul>
								<li><?php echo anchor ('#', 'Transaksi');?></li>
								<ul>
									<li><?php echo anchor ('PeminjamanController', 'Peminjaman');?></li>
									<li><?php echo anchor ('#', 'Pengembalian');?></li>
								</ul>
							</ul>
							<ul>
								<li><?php echo anchor ('LaporanController/pdfInventaris', 'Laporan');?></li>
							</ul>

						</div>
					</div>
				</div>

				<div class="col-9">
					<div class="card">
						<div class="card-header">
							<?php echo $judul_content; ?>
						</div>
						<div class="card-body">
							<?php $this->load->view($isi_content); ?>
						</div>
					</div>
		<script type="text/javascript" src= "<?php echo base_url ('/asset/vendor/js/bootstrap.min.js');?>"></script>
	</body>
</html>