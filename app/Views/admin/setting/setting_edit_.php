<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Setting</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('/admin')?>">Dashboard</a></li>
                <li class="breadcrumb-item active">setting</li>
            </ol>
            <?php if(session()->getFlashdata('message') !== NULL){
                echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
            } ?>
            
            <div class="card shadow-lg border-0 mb-4">
                <!-- <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div> -->
                <div class="card-body">
                    <form class="" autocomplete="off" action="<?=base_url('/admin/setting') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" id="name" name="name" value="<?=$settings->name ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="text" id="email" name="email" value="<?=$settings->email ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" type="text" id="phone" name="phone" value="<?=$settings->phone ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input class="form-control" type="text" id="address" name="address" value="<?=$settings->address ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input class="form-control" type="text" id="website" name="website" value="<?=$settings->website ?>" > 
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="facebook_link">facebook_link</label>
                                    <input class="form-control" type="text" id="facebook_link" name="facebook_link" value="<?=$settings->facebook_link ?>" > 
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="twitter_link">twitter_link</label>
                                    <input class="form-control" type="text" id="twitter_link" name="twitter_link" value="<?=$settings->twitter_link ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="linkedin_link">linkedin_link</label>
                                    <input class="form-control" type="text" id="linkedin_link" name="linkedin_link" value="<?=$settings->linkedin_link ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="youtube_link">youtube_link</label>
                                    <input class="form-control" type="text" id="youtube_link" name="youtube_link" value="<?=$settings->youtube_link ?>" >
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="instagram_link">instagram_link</label>
                                    <input class="form-control" type="text" id="instagram_link" name="instagram_link" value="<?=$settings->instagram_link ?>" >
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-3">Submit</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?=$this->endSection()?>