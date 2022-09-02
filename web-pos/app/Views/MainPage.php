<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Majo POS</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?=base_url('/assets/bootstrap/dist/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/@fortawesome/fontawesome-free/css/all.css')?>">
    <link rel="stylesheet" href="<?=base_url()?>/assets/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/assets/summernote/dist/summernote-bs4.css">

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
    <script src="<?=base_url()?>/assets/jquery/dist/jquery.min.js"></script>
    <script src="<?=base_url()?>/assets/popper/popper.js"></script>
    <script src="<?=base_url()?>/assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/assets/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?=base_url()?>/assets/jquery/jquery.form.min.js"></script>
    <script src="<?=base_url()?>/assets/select2/dist/js/select2.full.min.js"></script>
    <script src="<?=base_url()?>/assets/summernote/dist/summernote-bs4.js"></script>
    <script src="<?=base_url('/assets/moment/min/moment.min.js')?>"></script>
    <script src="<?=base_url('/assets/js/stisla.js')?>"></script>
    
    <!-- Template JS File -->
    <script src="<?=base_url()?>/assets/js/scripts.js"></script>
    <script src="<?=base_url()?>/assets/js/custom.js"></script>
    <script>
      $(document).ready(function() {
        $('#upload_modal').on('show.bs.modal', function (e) 
        {
          $("#file").val("");
          $("#label_file").text("Attach File");

          $(".progress").hide();
          $(".alert-danger").hide();

          $("#form_upload").removeClass("was-validated");
        });

        $('#form_upload').ajaxForm(
        {
          beforeSend: function(xhr)
          {
            $(".progress").show();

            var percent = "0%";

            $("#progressbar").css({"width":percent});
            $("#progressbar").text(percent);
            
          },
          uploadProgress: function(event, position, total, percent_position)
          {
            var percent = percent_position + "%";

            $("#progressbar").css({"width":percent});
            $("#progressbar").text(percent);
          },
          success: function()
          {
            var percent = "100%";

            $("#progressbar").css({"width":percent});
            $("#progressbar").text(percent);
          },
          complete: function(xhr)
          {
            var response = JSON.parse(xhr.responseText);

            if(response.code == "00")
            {
              var file_name = response.data.file_name;

              $("#attachment").hide();
              $(".picture").val(file_name)
              $("#picture").show();

              $('#upload_modal').modal('hide');
            }
            else
            {
              $(".alert-danger").show();
              $(".alert-danger").empty();
              $(".alert-danger").html(response.message['document'] + 
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + 
                  '<span aria-hidden="true">×</span>' + 
                '</button>');

              $(".progress").hide();
            }
          }
        });
      });
    </script>
  </body>
</html>
