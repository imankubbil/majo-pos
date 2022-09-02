<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Majo POS</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?=base_url('/assets/bootstrap/dist/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/@fortawesome/fontawesome-free/css/all.css')?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?=base_url('/assets/css/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/components.css')?>">
  </head>

  <body>
    <div id="app">
      <div class="main-wrapper">
        <?= $this->include('_layouts/navbar')?>
        
        <?= $this->include('_layouts/sidebar')?>
        <!-- Main Content -->
        <div class="main-content">
          <?= $this->renderSection('content'); ?>
        </div>

        <?= $this->include('_layouts/footer')?>
      </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?=base_url('/assets/jquery/dist/jquery.min.js')?>"></script>
    <script src="<?=base_url('/assets/popper.js/dist/popper.min.js')?>"></script>
    <script src="<?=base_url('/assets/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('/assets/jquery.nicescroll/dist/jquery.nicescroll.min.js')?>"></script>
    <script src="<?=base_url('/assets/moment/min/moment.min.js')?>"></script>
    <script src="<?=base_url('/assets/js/stisla.js')?>"></script>
    
    <!-- Template JS File -->
    <script src="<?=base_url()?>/assets/js/scripts.js"></script>
    <script src="<?=base_url()?>/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?=base_url()?>/assets/js/page/index-0.js"></script>

    <script>
      $(document).ready(function() {
        $(".modal-condition").on('click', function() {
          var nomor = $(this).data('no');
          
          $.ajax({
              type: 'GET',
              url: '<?= base_url('kondisi-barang/detail')?>/'+ $(this).data('kode'),

              success: function(response) 
              {
                var data = JSON.parse(response);
                var jenis = data.jenis_product + '-' + data.ukuran_product;

                $('.kode_product').val(data.kode_product);
                $('.jenis').val(jenis);
                $('.kadaluarsa').val(data.kadaluarsa_product);
                $('.lokasi').val(data.lokasi_product);
                $('.indikator_tekanan').val(capitalize(data.indikator_tekanan));
                $('.label').val(capitalize(data.label));
                $('.selang').val(capitalize(data.selang));
                $('.pin_pengaman').val(capitalize(data.pin_pengaman));
                $('.segel').val(capitalize(data.segel));
                $('.tabung').val(capitalize(data.tabung));
                $('.keterangan').val(capitalize(data.keterangan));
                $('.tanggal').val(data.created_at);
                $('.pemeriksa').val(capitalize(data.nama_user));
              }
          });
        }).fireModal({
            title: 'Detail Condition Equipment',
            body: $("#detail-condition"),
            size: 'modal-lg'
        });

        function capitalize(str){
          return str.toLowerCase().replace(/(?<= )[^\s]|^./g, a => a.toUpperCase());
        }
      });
    </script>
  </body>
</html>
