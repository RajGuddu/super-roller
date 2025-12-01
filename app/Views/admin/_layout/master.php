<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=base_url('public/assets/admin/img/favicon.png')?>" rel="icon">
  <link href="<?=base_url('public/assets/admin/img/apple-touch-icon.png')?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=base_url('public/assets/admin/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('public/assets/admin/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?=base_url('public/assets/admin/vendor/boxicons/css/boxicons.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('public/assets/admin/vendor/quill/quill.snow.css')?>" rel="stylesheet">
  <link href="<?=base_url('public/assets/admin/vendor/quill/quill.bubble.css')?>" rel="stylesheet">
  <link href="<?=base_url('public/assets/admin/vendor/remixicon/remixicon.css')?>" rel="stylesheet">
  <link href="<?=base_url('public/assets/admin/vendor/simple-datatables/style.css')?>" rel="stylesheet">
  <script src="<?=base_url('public/assets/admin/js/jquery-3.7.1.min.js')?>" ></script>

  <!-- Template Main CSS File -->
  <link href="<?=base_url('public/assets/admin/css/style.css')?>" rel="stylesheet">

  <style>
      .img-box{
          position: relative;
          height: 180px;
          width: 160px;
      }
      .img-box img{
          height: 150px;
          width: 140px;
      }
      .img-box .image-title{
          width: 100%;
          text-align: center;
      }
      .img-box span.cancel-icon{
          position: absolute;
          color: red;
          cursor: pointer;
          width: 100%;
          text-align: center;
          margin: auto;
      }
  </style>

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <?=$this->include("admin/_layout/navbar")?>
  

  <?=$this->include("admin/_layout/sidebar")?>
  

  <?= $this->renderSection("content"); ?>
  

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <?php /*  <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div> */ ?>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?=$this->include("admin/_layout/fileuploadmodal")?>

  <!-- Vendor JS Files -->
  <!-- <script type='text/javascript' src="<?= base_url('public/js/jquery.min.js'); ?>"></script> -->
  
  <script src="<?=base_url('public/assets/admin/vendor/apexcharts/apexcharts.min.js')?>"></script>
  <script src="<?=base_url('public/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?=base_url('public/assets/admin/vendor/chart.js/chart.umd.js')?>"></script>
  <script src="<?=base_url('public/assets/admin/vendor/echarts/echarts.min.js')?>"></script>
  <script src="<?=base_url('public/assets/admin/vendor/quill/quill.js')?>"></script>
  <script src="<?=base_url('public/assets/admin/vendor/simple-datatables/simple-datatables.js')?>"></script>
  <script src="<?=base_url('public/assets/admin/vendor/tinymce/tinymce.min.js')?>"></script>
  <script src="<?=base_url('public/assets/admin/vendor/php-email-form/validate.js')?>"></script>

  <!-- Template Main JS File -->
  <script src="<?=base_url('public/assets/admin/js/main.js')?>"></script>
  <script>
    function cancel_image(table, field, pkey, id){
        if(confirm('Are u sure?')){
            $.ajax({
                type: 'POST',
                url: '<?=base_url('admin/remove_image')?>',
                data: {table:table, field:field, pkey:pkey, id:id},
                success: function(){
                    window.location.reload();
                }
            });
        }else{
            return false;
        }
    }
  </script>

</body>

</html>