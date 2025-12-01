
<?=$this->extend("include/master") ?>
<?=$this->section("content") ?>

  <!-- banner start -->
  <!-- <div class="banner_section" style="background-image: url(images/about-bg.png);">
    <div class="container">
      <div class="banner-content text-center">
        <h1 class="text-white ">About Us<br>
         </h1>
      </div>
    </div>
  </div> -->
  <!-- banner end -->

  
  
 <section class="get-in-tuch panel-space-y">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6">
                <img src="<?=base_url('public/assets/images/get-tuch-img.png')?>" width="100%">
            </div>
            <div class="col-md-6 getin-box">
                <h4>We’d love to hear from you!
                    Let’s get in touch</h4>
                    <form action="<?=base_url('/save_contact_us')?>" method="post" class="" id="contact_us_form">
                       <div class="row">
                        <div class="form-group col-md-6 pt-3">
                            <label for="exampleFormControlInput1">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=set_value('name')?>" placeholder="Enter your full name">
                            <span class="text-danger" id="nameErr"></span>
                        </div>
                        <div class="form-group col-md-6 pt-3">
                            <label for="country">Country</label>
                            <select class="form-select" aria-label="Default select example" id="country" name="country">
                              <option value="">Select your country</option>
                              <?php if(!empty($countries)){
                              foreach($countries as $list){ ?>
                                <option value="<?=$list->countries_id ?>" <?=set_select('country', $list->countries_id )?>><?=$list->countries_name?></option>
                              <?php } } ?>
                            </select>
                            <span class="text-danger" id="countryErr"></span>
                        </div>
                        <div class="form-group col-md-6 pt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email')?>" placeholder="Enter your email">
                            <span class="text-danger" id="emailErr"></span>
                        </div>
                        <div class="form-group col-md-6 pt-3">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone')?>" placeholder="Enter your phone no">
                            <span class="text-danger" id="phoneErr"></span>
                        </div>
                        <!-- <div class="form-group  pt-3">
                            <label for="exampleFormControlInput1">Subject</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1">
                        </div> -->
                        <div class="form-group pt-3">
                            <label for="message">Your message</label>
                            <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                          </div>
                          <div class="buuton-div">
                            <a href="javascript:void(0)" class="send-btn" id="contact-submit-btn">Send <span><i class="fa-solid fa-arrow-right-long"></i></span> </a>
                          </div>
                       </div>
                    </form>
            </div>
        </div>
        <div class=" contact-locatin pt-4 ">
          <a href="#">
            <div class=" c-l-box ">
                <img src="<?=base_url('public/assets/images/cont-icon1.png')?>">
                <p class="mb-0">SRFMPL2021@GMAIL.COM</p>
            </div>
          </a>
          <a href="#">
            <div class=" c-l-box">
                <img src="<?=base_url('public/assets/images/cont-icon2.png')?>">
                <p class="mb-0"> +91 9136 607696</p>
            </div>
          </a>
           <a href="#">
            <div class=" c-l-box">
                <img src="<?=base_url('public/assets/images/cont-icon3.png')?>">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
            </div>
           </a>
        </div>
    </div>
 </section>

  <section class="brand-section panel-space-y ">
    <div class="container pb-5 text-center">
        <h3 class="color-red fw-font-5 pb-3 ">About Our Brand</h3>
        <p class="text-colur pb-3 p-font-siz">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <img src="<?=base_url('public/assets/images/brand--1.png')?>" width="100%">
    </div>
</section>
  
<?=$this->endSection()?>