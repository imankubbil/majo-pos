<?= $this->extend('MainPage') ?>

<?= $this->section('content') ?>
	<div class="section">
		<div class="section-header">
			<div class="section-header-back">
				<a href="<?= site_url('category') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
			</div>
			<h1>Edit Category</h1>
		</div>
		<div class="section-body">
			<div class="card">
				<form class="needs-validation" action="<?= site_url("category/{$category['id']}") ?>" method="post" novalidate="">
					<?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
					<div class="card-body">
						<div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= $category['name'] ?>" required="" autofocus="">
                                    <div class="invalid-feedback">
                                        Name cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" name="description"  value="<?= $category['description'] ?>"  required="" autofocus="">
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