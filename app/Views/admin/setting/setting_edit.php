<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Settings</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url('/admin')?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Settings</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php if(session()->getFlashdata('message') !== NULL){
                                echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                            } ?>
                        </h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" autocomplete="off" action="<?=base_url('/admin/setting') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?=$settings->name ?>">
                            </div>
                            <div class="col-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?=$settings->email ?>">
                            </div>
                            <div class="col-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?=$settings->phone ?>">
                            </div>
                            <div class="col-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?=$settings->address ?>">
                            </div>
                            <div class="col-6">
                                <label for="website" class="form-label">Website</label>
                                <input class="form-control" type="text" id="website" name="website" value="<?=$settings->website ?>" >
                            </div>
                            <div class="col-6">
                                <label for="facebook_link" class="form-label">facebook_link</label>
                                <input class="form-control" type="text" id="facebook_link" name="facebook_link" value="<?=$settings->facebook_link ?>" > 
                            </div>
                            <div class="col-6">
                                <label for="twitter_link" class="form-label">twitter_link</label>
                                <input class="form-control" type="text" id="twitter_link" name="twitter_link" value="<?=$settings->twitter_link ?>" >
                            </div>
                            <div class="col-6">
                                <label for="linkedin_link" class="form-label">linkedin_link</label>
                                <input class="form-control" type="text" id="linkedin_link" name="linkedin_link" value="<?=$settings->linkedin_link ?>" >
                            </div>
                            <div class="col-6">
                                <label for="youtube_link" class="form-label">youtube_link</label>
                                <input class="form-control" type="text" id="youtube_link" name="youtube_link" value="<?=$settings->youtube_link ?>" >
                            </div>
                            <div class="col-6">
                                <label for="instagram_link" class="form-label">instagram_link</label>
                                <input class="form-control" type="text" id="instagram_link" name="instagram_link" value="<?=$settings->instagram_link ?>" >
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="<?= base_url('admin')?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div><!-- End Left side columns -->

            <!-- Right side columns -->
        </div>
        </section>

    </main><!-- End #main -->

<?=$this->endSection()?>