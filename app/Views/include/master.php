<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome to Super Roller</title>
  <!-- Include Bootstrap CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!--Include Custom CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300..700;1,300..700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url('public/assets/css/owl.carousel.css'); ?>">
  <link rel="stylesheet" href="<?=base_url('public/assets/css/swiper-bundle.min.css'); ?>">
  <link rel="stylesheet" href="<?=base_url('public/assets/css/style.css'); ?>">
  <link rel="stylesheet" href="<?=base_url('public/assets/css/media-query.css'); ?>">
  <script src="<?=base_url('public/assets/js/jquery.min.js')?>"></script>
</head>

<body>

  <!-- header start -->
  <?=$this->include("include/header")?>
  <!-- header end -->
  
  <?= $this->renderSection("content"); ?>

  <!-- footer start -->
  <?=$this->include("include/footer")?>

  <!-- footer end -->

  <!-- modal -->

  <div class="modal fade search-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">

        <div class="modal-body">
          <div class="search-input w-75 m-auto">

            <form role="search" method="get" class="search-form" action="#">
              <label for="search-form-2">Search&hellip;</label>
              <input type="search" id="search-form-2" class="search-field" value="" name="s" />
              <input type="submit" class="search-submit" value="Search" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <?php 
    $swal_session = array();
    $swalflag = 0;
    if(session()->has('swal_session')){
      $swal_session = session('swal_session');
      $swalflag = 1;
      unset($_SESSION['swal_session']);
    } ?>

  <!-- Optional JavaScript; choose one of the two! -->
  
  <!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="<?=base_url('public/assets/js/owl.carousel.js')?>"></script>
  <script src="<?=base_url('public/assets/js/swiper-bundle.min.js')?>"></script>
  <script src="<?=base_url('public/assets/js/custom.js')?>"></script>
  <script src="<?=base_url('public/assets/sweetalert/sweetalert.min.js')?>"></script>
  <script>
    var swalflag = '<?=$swalflag?>';
    $(document).ready(function(){
        if(swalflag == '1'){
          swal({
              title: "<?=(!empty($swal_session))?$swal_session['title']:''?>",
              text: "<?=(!empty($swal_session))?$swal_session['text']:''?>",
              icon: "<?=(!empty($swal_session) && isset($swal_session['icon']))?$swal_session['icon']:'success'?>",
              button: "Close",
          });
          $(".swal-text, .swal-footer").addClass('text-center');
          $(".swal-button--confirm").addClass('btn-success');
        }
    });
    $('#contact-submit-btn').click(function(){
        $('#nameErr').html('');
        $('#countryErr').html('');
        $('#emailErr').html('');
        $('#phoneErr').html('');
        var frm = $('#contact_us_form');
        var formData = new FormData(frm[0]);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('/save_contact_us') ?>",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            cache: 'false',
            success: function(res){
                console.log(res);
                if(res.error != undefined){
                    if(res.error.name != undefined && res.error.name != ''){
                        $('#nameErr').html(res.error.name);
                    }
                    if(res.error.country != undefined && res.error.country != ''){
                        $('#countryErr').html(res.error.country);
                    }
                    if(res.error.email != undefined && res.error.email != ''){
                        $('#emailErr').html(res.error.email);
                    }
                    if(res.error.phone != undefined && res.error.phone != ''){
                        $('#phoneErr').html(res.error.phone);
                    }
                    
                }else{
                    if(res.msg == 'success'){
                        window.location.reload();
                    }else if(res.err == 'fail'){
                        alert('Something went wrong. Please try again!');
                    }
                }
            }
        });
    });

    $('.owl-carousel-presentage').owlCarousel({
    loop:true,
    margin:100,
    nav:false,
    dots:false,
    loop:true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
$('.owl-carousel-testmonial').owlCarousel({
    loop:true,
    margin:20,
    nav:false,
    dots:true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4.3
        }
    }
})
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:20,
    nav:false,
    responsive:{
        0:{
            items:1.
        },
        600:{
            items:2.2
        },
        1000:{
            items:5.1
        }
    }
})
  </script>
  



</body>

</html>