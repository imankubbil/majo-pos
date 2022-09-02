<div class="main-sidebar">
	<aside id="sidebar-wrapper">
	<div class="sidebar-brand">
		<a href="<?= site_url() ?>">Majo POS</a>
	</div>
	<div class="sidebar-brand sidebar-brand-sm">
		<a href="index.html">MPOS</a>
	</div>
	<ul class="sidebar-menu">
		<li class="nav-item">
			<a href="<?= site_url('admin') ?>" class="nav-link">
				<i class="fas fa-user"></i><span>Admin</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= site_url('customer') ?>" class="nav-link">
				<i class="fas fa-users"></i><span>Customer</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= site_url('supplier') ?>" class="nav-link">
				<i class="fas fa-user-tie"></i><span>Supplier</span></a>
		</li>
		<li class="nav-item">
			<a href="<?= site_url('unit')?>" class="nav-link">
				<i class="fas fa-circle"></i><span>Unit</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= site_url('category')?>" class="nav-link">
				<i class="fas fa-circle"></i><span>Category</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= site_url('product')?>" class="nav-link">
				<i class="fas fa-circle"></i><span>Product</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= site_url('logout')?>" class="nav-link text-danger">
				<i class="fas fa-sign-out-alt"></i><span>Logout</span>
			</a>
		</li>
	</ul>
	</aside>
</div>