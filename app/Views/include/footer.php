    <?php
        $commonmodel = model('App\Models\Common_model', false);
        $settings = $commonmodel->get_setting(1);
        $tel1 = str_replace('-','',$settings->phone); 
        // $tel2 = str_replace('-','',$settings->phone2);
    ?>
    <footer class="footer ">
        <div class="top-footer panel-space-y">
        <div class="container">
            <div class="row g-4">
            <div class="col-lg-5 col-md-12 col-first">
                <img src="<?=base_url('public/assets/images/footer-logo.png')?>" class="img-fluid footer-logo pb-3" alt="Footer Logo">
                <h6 class="col-firsts">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h6>
                <div class="social-links d-flex">
                <a href="<?=$settings->facebook_link?>" class="facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="<?=$settings->twitter_link?>" class="twitter"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="<?=$settings->youtube_link?>" class="youtube"><i class="fa-brands fa-youtube"></i></a>
                <a href="<?=$settings->instagram_link?>" class="instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="<?=$settings->linkedin_link?>" class="linkedin"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 footer-links">
                <h6>Our Policies</h6>
                <ul class="p-0 list-unstyled">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Term & Conditions</a></li>
                <li><a href="#">Shipping & Cancellation</a></li>
                <li><a href="#">Return & Refund</a></li>
                
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 footer-links">
                <h6>Information</h6>
                <ul class="p-0 list-unstyled">
                <li><a href="#">Product</a></li>
                <li><a href="#">Industries</a></li>
                <li><a href="#">Company</a></li>
                <li><a href="#">Board of Directors</a></li>
                
                </ul>
            </div>
            <div class="col-lg-2 col-md-5 footer-links">
                <h6>Contact us</h6>
                <ul class="p-0 list-unstyled">
                <address>
                    <?=$settings->address?>
                </address>
                <li><a href="#"><?=$settings->phone?></a></li>
                <li><a href="#"><?=$settings->email?></a></li>
                
                </ul>
            </div>
            </div>
        </div>
        </div>
    
    </footer>