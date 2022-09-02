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
			<a href="<?= site_url('user') ?>" class="nav-link">
				<i class="fas fa-users"></i><span>User</span>
			</a>
		</li>
		<li class="nav-item">
			<a href="<?= site_url('equipment') ?>" class="nav-link">
				<i class="fas fa-fire-extinguisher"></i>
				<span>Equipment</span
			></a>
		</li>
		<li class="nav-item">
			<a href="<?= site_url('kondisi-barang')?>" class="nav-link">
				<i class="fas fa-clipboard-check"></i><span>Condition Equipment</span>
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