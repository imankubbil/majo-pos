<?= $this->extend('MainPage') ?>

<?= $this->section('content') ?>
	<div class="section">
		<div class="section-header">
			<h1>Customer</h1>
			<div class="section-header-button">
				<a href="<?= site_url('customer/new') ?>" class="btn btn-primary"> Add Customer </a>
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
                        $email = (isset(session()->getFlashdata('error')['email'])) ? session()->getFlashdata('error')['email'] : '';
                        $password = (isset(session()->getFlashdata('error')['password'])) ? session()->getFlashdata('error')['password'] : '';
                        $customer = (isset(session()->getFlashdata('error')['customer'])) ? session()->getFlashdata('error')['customer'] : '';
                    ?>
                    <?php if($name !== '') echo $name; ?>
                    <?php if($email !== '') echo "</br>".$email; ?>
                    <?php if($password !== '') echo "</br>".$password; ?>
                    <?php if($customer !== '') echo "</br>".$customer; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="section-body">
			<div class="card">
					<div class="card-header">
						<h4>List Administrator</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-md">
								<thead>
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Email</th>
										<th>Created At</th>
										<th>Update At</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($customers['customers'] as $key => $value) : ?>
										<tr>
											<th scope="row"><?= (int)$key + 1?></th>
											<td><?= $value['name']?></td>
											<td><?= $value['email']?></td>
											<td><?= $value['created_at']?></td>
											<td><?= $value['updated_at']?></td>
											<td>
												<a href='<?= site_url("customer/{$value['id']}/edit") ?>' class="btn btn-warning btn-sm">
													<i class="fas fa-pencil-alt"></i> Edit
												</a>
												<form action='<?= site_url("customer/{$value['id']}") ?>' method="post" class="d-inline">
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