<?= $this->extend('MainPage') ?>

<?= $this->section('content') ?>
	<div class="section">
		<div class="section-header">
			<h1>Product</h1>
			<div class="section-header-button">
				<a href="<?= site_url('product/new') ?>" class="btn btn-primary"> Add Product </a>
			</div>
		</div>

		<?php if(session()->getFlashdata('success')) : ?>
			<div class="alert alert-success alert-dismissible show fade">
				<div class="alert-body">
					<button class="close" data-dismiss="alert">x</button>
					<?= session()->getFlashdata('success') ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if(session()->getFlashdata('error')) : ?>
			<div class="alert alert-danger alert-dismissible show fade">
				<div class="alert-body">
					<button class="close" data-dismiss="alert">x</button>
                    <?php 
                        $name = (isset(session()->getFlashdata('error')['name'])) ? session()->getFlashdata('error')['name'] : '';
                        $unit = (isset(session()->getFlashdata('error')['unit'])) ? session()->getFlashdata('error')['unit'] : '';
                        $category = (isset(session()->getFlashdata('error')['category'])) ? session()->getFlashdata('error')['category'] : '';
                        $supplier = (isset(session()->getFlashdata('error')['supplier'])) ? session()->getFlashdata('error')['supplier'] : '';
                        $price = (isset(session()->getFlashdata('error')['price'])) ? session()->getFlashdata('error')['price'] : '';
                        $picture = (isset(session()->getFlashdata('error')['picture'])) ? session()->getFlashdata('error')['picture'] : '';
                        $description = (isset(session()->getFlashdata('error')['description'])) ? session()->getFlashdata('error')['description'] : '';
                        $product = (isset(session()->getFlashdata('error')['product'])) ? session()->getFlashdata('error')['product'] : '';
                    ?>
                    <?php if($name !== '') echo $name; ?>
                    <?php if($unit !== '') echo "</br>".$unit; ?>
                    <?php if($category !== '') echo "</br>".$category; ?>
                    <?php if($supplier !== '') echo "</br>".$supplier; ?>
                    <?php if($price !== '') echo "</br>".$price; ?>
                    <?php if($picture !== '') echo "</br>".$picture; ?>
                    <?php if($description !== '') echo "</br>".$description; ?>
                    <?php if($product !== '') echo "</br>".$product; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="section-body">
			<div class="card">
					<div class="card-header">
						<h4>List Product</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-md">
								<thead>
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Description</th>
										<th>Price</th>
										<th>Unit</th>
										<th>Category</th>
										<th>Supplier</th>
										<th>Created At</th>
										<th>Update At</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($products['products'] as $key => $value) : ?>
										<tr>
											<th scope="row"><?= (int)$key + 1?></th>
											<td><?= $value['name']?></td>
											<td><?= $value['description']?></td>
											<td><?= $value['price']?></td>
											<td><?= $value['unit_name']?></td>
											<td><?= $value['category_name']?></td>
											<td><?= $value['supplier_name']?></td>
											<td><?= $value['created_at']?></td>
											<td><?= $value['updated_at']?></td>
											<td>
												<a href='<?= site_url("product/{$value['id']}/edit") ?>' class="btn btn-warning btn-sm">
													<i class="fas fa-pencil-alt"></i> Edit
												</a>
												<form action='<?= site_url("product/{$value['id']}") ?>' method="post" class="d-inline">
												<?= csrf_field() ?>
													<input type="hidden" name="_method" value="DELETE">
													<button class="btn btn-danger btn-sm">
														<i class="fas fa-trash"></i> Hapus
													</button>
												</form>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
			</div>
		</div>
	</div>
	</div>
<?= $this->endSection() ?>