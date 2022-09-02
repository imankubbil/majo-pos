<?= $this->include('_layouts/css')?>

	<div class="section">
		<div class="section-header">
			<h1>Majo Teknologi Indonesia</h1>
		</div>
		
		<div class="section-body">
			<div class="card">
				<div class="card-header">
					<h3>Product</h3>
				</div>
				<div class="card-body">
					<div class="row">
						<?php foreach ($products['products'] as $key => $value) : ?>
							<div class="col-sm-3">
								<div class="card card-success">
									<article class="article article-style-c">
										<div class="article-header">
											<div class="article-image img-fluid" data-background="<?=base_url("/upload/product/{$value['picture']}")?>" style="background-image: url(&quot;<?=base_url("/upload/product/{$value['picture']}")?>&quot;);">
											</div>
										</div>
										<div class="article-details">
											<div class="article-title">
												<h2 class="text-center">
													<?=$value['name']?>
												</h2>
												<h4 class="text-center">
													Rp. <?= number_format($value['price'], 0, ",", "."); ?>
												</h4>
											</div>
											<p class="text-justify">
												<?= $value['description'] ?>
											</p>
											<div class="article-cta">
												<div class="text-center">
													<a href="#" class="btn btn-primary">Beli</a>
												</div>
											</div>
										</div>
									</article>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?= $this->include('_layouts/javascript')?>