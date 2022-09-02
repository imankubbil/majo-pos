<?= $this->extend('MainPage') ?>

<?= $this->section('content') ?>
	<div class="section">
		<div class="section-header">
			<div class="section-header-back">
				<a href="<?= site_url('supplier') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
			</div>
			<h1>Edit Supplier</h1>
		</div>
		<div class="section-body">
			<div class="card">
				<form class="needs-validation" action="<?= site_url("supplier/{$supplier['id']}") ?>" method="post" novalidate="">
					<?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
					<div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= $supplier['name'] ?>" autofocus="">
                                    <div class="invalid-feedback">
                                        Name cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $supplier['email'] ?>" autofocus="">
                                    <div class="invalid-feedback">
                                        Email cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label email="phone">Phone</label>
                                    <input type="phone" class="form-control" name="phone" value="<?= $supplier['phone'] ?>" maxlength="13" autofocus="">
                                    <div class="invalid-feedback">
                                        Phone cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label email="address">Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="10" style="height: 100px;"> <?= $supplier['address'] ?> </textarea>
                                    <div class="invalid-feedback">
                                        Address cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label email="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="10" style="height: 100px;"><?= $supplier['description'] ?></textarea>
                                    <div class="invalid-feedback">
                                        Description cannot be empty
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </div>
				</form>
			</div>
		</div>
	</div>
	</div>
<?= $this->endSection() ?>