    <?php $uri = service('uri'); 
        $seg1 = $uri->getSegment(1); 
        
        ?>
    <!-- header start -->
    <header class="bonvoyage-header fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark desktop-view d-none d-lg-block" id="navbar_top">
        <div class="container">
            <a class="logo" href="<?=base_url(); ?>">
            <img src="<?=base_url('public/assets/images/super-role-logo.png')?>" alt="Super Roller Logo">
            </a>
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?=($seg1 == '')?'activess':''?> "  href="<?=base_url(); ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=($seg1 == 'about-us')?'activess':''?>" href="<?=base_url('/about-us'); ?>">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Product</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Board of Directors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=($seg1 == 'contact-us')?'activess':''?>" href="<?=base_url('contact-us'); ?>">Contact us</a>
            </li>
            
            <form class="d-flex cart-search " role="search">
                <div class="search-icon">
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
                </div>
                <div class="search-icon">
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-regular fa-user"></i>
                </a>
                
                </div>
                <div class="search-icon">
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
                </div>
            </form>
            </ul>


        </div>
        </nav>

        <nav class="navbar navbar-expand-lg navbar-dark mobile-view d-lg-none" id="navbar_top">
        <div class="container">
            <a class="logo" href="<?=base_url(); ?>">
                <img src="<?=base_url('public/assets/images/super-role-logo.png')?>" alt="Super Roller Logo">
            </a>
            <button class="navbar-toggler text-black" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                <a class="nav-link" href="<?=base_url(); ?>">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?=base_url('/about-us'); ?>">About Us</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link" href="#">Product</a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link ">Board of Directors</a>
                </li>
            
                <li class="nav-item">
                <a class="nav-link" href="<?=base_url('contact-us'); ?>">Contact us</a>
                </li>
    
            </ul>
            </div>
    
        </div>
        </nav>

    
    </header>
    <!-- header end -->