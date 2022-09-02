<!DOCTYPE html>
<html lang="en">
  <?= $this->include('_layouts/css')?>
  <link rel="stylesheet" href="<?=base_url()?>/assets/bootstrap-social/bootstrap-social.css">
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            
            <div class="card card-success mt-5">
              <div class="login-brand">
                <img src="<?=base_url()?>/logo.png" alt="logo" width="150">
                <h2 class="text-center">Login POS</h2>
              </div>

              <div class="card-body">

                <?php if(session()->getFlashdata('error')) : ?>
                  <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert">x</button>
                      <b>Error !</b>
                      <br>
                      <?= session()->getFlashdata('error') ?>
                    </div>
                  </div>
                <?php endif; ?>

                <form method="POST" action="<?= site_url('process')?>" class="needs-validation" novalidate="">
                  <?= csrf_field() ?>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
              <div class="simple-footer">
                Copyright &copy; Majo POS <?= date('Y') ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?= $this->include('_layouts/javascript')?>
</body>
</html>
