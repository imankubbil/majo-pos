<?= $this->extend('MainPage') ?>

<?= $this->section('content') ?>
	<div class="section">
		<div class="section-header">
			<div class="section-header-back">
				<a href="<?= site_url('product') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
			</div>
			<h1>Add Product</h1>
		</div>
		<div class="section-body">
			<div class="card">
				<form class="needs-validation" action="<?= site_url('product') ?>" method="post" novalidate="">
					<?= csrf_field() ?>
					<div class="card-body">
						<div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" required="" autofocus="">
                                    <div class="invalid-feedback">
                                        Name cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="name">Unit</label>
                                    <select class="form-control select2" name="unit" id="unit">
                                        <?php foreach($units['units'] as $value) : ?>
                                            <option value="<?=$value['id']?>"> <?= $value['name']?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Unit cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="category">Category</label>
                                    <select class="form-control select2" name="category" id="category">
                                        <?php foreach($categories['categories'] as $value) : ?>
                                            <option value="<?=$value['id']?>"> <?= $value['name']?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Category cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="supplier">Supplier</label>
                                    <select class="form-control select2" name="supplier" id="supplier">
                                        <?php foreach($suppliers['suppliers'] as $value) : ?>
                                            <option value="<?=$value['id']?>"> <?= $value['name']?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Suppliers cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" required="" autofocus="">
                                    <div class="invalid-feedback">
                                        Price cannot be empty
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label email="picture">Picture</label>
                                    <div id="picture" style="display: none;">
                                        <input type="text" class="form-control picture" disabled required>
                                        <input type="hidden" class="form-control picture" name="picture" required>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-block" style="height: 42px;" data-toggle="modal" data-remote="" data-target="#upload_modal"  data-whatever='' id="attachment">Attachment</button>
                                </div>
                                <div class="col-sm-12">
                                    <label email="description">Description</label>
                                    <textarea class="form-control summernote" name="description" id="description"></textarea>
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
    <div class="modal fade" id="upload_modal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="m-0 font-weight-bold text-primary">Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                </div>
                <form method="post" action="upload" enctype="multipart/form-data" id="form_upload">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="picture">Upload Picture</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="picture" name="picture" accept=".png" required>
                                    <label class="custom-file-label" id="label_picture" for="picture">Attach File</label>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Format dokumen .png</small>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" id="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">    
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="action" id="btn-upload" value="Submit">Upload</button>
                    </div>
                <?= form_close() ?>
            </div>   
        </div>
    </div>
<?= $this->endSection() ?>