    <?php 
        $request = \Config\Services::request();
        $uri = $request->getUri();
        $segment1 = $uri->getSegment(1);
        $segment2 = $uri->getSegment(2);
        
    ?>
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link <?=($segment2 == '')?'':'collapsed'?>" href="<?=base_url('admin')?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-heading">Home </li>
    <li class="nav-item">
        <a class="nav-link <?=($segment2 == 'testimonial')?'':'collapsed'?>" href="<?php echo base_url('/admin/testimonial'); ?>">
        <i class="bi bi-card-list"></i>
        <span>Testimonial</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?=($segment2 == 'contact-us-list')?'':'collapsed'?>" href="<?php echo base_url('/admin/contact-us-list'); ?>">
        <i class="bi bi-card-list"></i>
        <span>Contact-us List</span>
        </a>
    </li>
    <li class="nav-heading">Product Management </li>
    <li class="nav-item">
        <a class="nav-link <?=($segment2 == 'products')?'':'collapsed'?>" href="<?php echo base_url('/admin/products'); ?>">
        <i class="bi bi-card-list"></i>
        <span>Products</span>
        </a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="components-alerts.html">
            <i class="bi bi-circle"></i><span>Products</span>
            </a>
        </li>
        <li>
            <a href="components-accordion.html">
            <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
        </li>
        
        </ul>
    </li>End Components Nav -->

    <li class="nav-heading">Settings</li>

    <li class="nav-item ">
        <a class="nav-link <?=($segment2 == 'setting')?'':'collapsed'?> " href="<?php echo base_url('/admin/setting'); ?>">
        <i class="bi bi-gear"></i>
        <span>Settings</span>
        </a>
    </li><!-- End Profile Page Nav -->

    <?php /* 
    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
        <i class="bi bi-question-circle"></i>
        <span>F.A.Q</span>
        </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
        </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
        <i class="bi bi-card-list"></i>
        <span>Register</span>
        </a>
    </li><!-- End Register Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
        </a>
    </li><!-- End Login Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
        </a>
    </li><!-- End Error 404 Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
        <i class="bi bi-file-earmark"></i>
        <span>Blank</span>
        </a>
    </li><!-- End Blank Page Nav --> */ ?>

    </ul>

    </aside><!-- End Sidebar-->