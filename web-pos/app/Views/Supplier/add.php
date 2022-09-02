<?= $this->extend('MainPage') ?>

<?= $this->section('content') ?>
	<div class="section">
		<div class="section-header">
			<div class="section-header-back">
				<a href="<?= site_url('supplier') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
			</div>
			<h1>Add Supplier</h1>
		</div>
		<div class="section-body">
			<div class="card">
				<form class="needs-validation" action="<?= site_url('supplier') ?>" method="post" novalidate="">
					<?= csrf_field() ?>
					<div class="card-body">
						<div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" required="" autofocus="">
                                    <div class="invalid-feedback">
                                        Name cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" required="" autofocus="">
                                    <div class="invalid-feedback">
                                        Email cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label email="phone">Phone</label>
                                    <input type="phone" class="form-control" name="phone" maxlength="13" required="" autofocus="">
                                    <div class="invalid-feedback">
                                        Phone cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label email="address">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="10" style="height: 100px;"></textarea>
                                    <div class="invalid-feedback">
                                        Address cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label email="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="10" style="height: 100px;"></textarea>
                                    <div class="invalid-feedback">
                                        Description cannot be empty
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
				</form>
			</div>
		</div>
	</div>
<?= $this->endSection() ?>