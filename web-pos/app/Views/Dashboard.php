<?= $this->extend('MainPage') ?>

<?= $this->section('content') ?>
	<div class="section">
		<div class="section-header">
			<div class="section-header-back">
				<a href="<?= site_url('equipment') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
			</div>
			<h1>Tambah Equipment</h1>
		</div>
		<div class="section-body">
			<div class="card">
				<form class="needs-validation" action="<?= site_url('equipment') ?>" method="post" novalidate="">
					<?= csrf_field() ?>
					<div class="card-header">
						<h4>Buat Equipment</h4>
					</div>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Kode Equipment</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="kode_product" required="" autofocus="">
								<div class="invalid-feedback">
									Kode Equipment Tidak Boleh Kosong
								</div>
							</div>
	
							<label class="col-sm-2 col-form-label">Merek Equipment</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="merk_product" required="" autofocus="">
								<div class="invalid-feedback">
									Merek Equipment Tidak Boleh Kosong
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Type Equipment</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="type_product" required="" autofocus="">
								<div class="invalid-feedback">
									Type Equipment Tidak Boleh Kosong
								</div>
							</div>
	
							<label class="col-sm-2 col-form-label">Jenis Equipment</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="jenis_product" required="" autofocus="">
								<div class="invalid-feedback">
									Jenis Equipment Tidak Boleh Kosong
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Ukuran Equipment</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="ukuran_product" required="" autofocus="">
								<div class="invalid-feedback">
									Ukuran Equipment Tidak Boleh Kosong
								</div>
							</div>
	
							<label class="col-sm-2 col-form-label">Lokasi Equipment</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="lokasi_product" required="" autofocus="">
								<div class="invalid-feedback">
									Lokasi Equipment Tidak Boleh Kosong
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Kadaluarsa</label>
							<div class="col-sm-4">
								<input type="date" class="form-control" name="kadaluarsa_product" required="" autofocus="">
								<div class="invalid-feedback">
									Kadaluarsa Tidak Boleh Kosong
								</div>
							</div>
						</div>
						
						<button class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
<?= $this->endSection() ?>