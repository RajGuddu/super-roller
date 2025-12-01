<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Change Password</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('/admin')?>">Dashboard</a></li>
                <li class="breadcrumb-item active">change-password</li>
            </ol>
            <?php if(session()->has('message')){
                echo session()->get('message');
            } ?>
            
            <div class="card shadow-lg border-0 mb-4">
                <!-- <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div> -->
                <div class="card-body">
                    <form class="" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-8 my-2">
                                <div class="form-group">
                                    <label for="oldpwd">Old Password</label>
                                    <input type="password" class="form-control" name="oldpwd" id="oldpwd" value="<?=set_value('oldpwd'); ?>" placeholder="Old Password">
                                    <span class="text-danger"><?=isset($validation)?$validation->showError('oldpwd'):''; ?></span>
                                </div>
                            </div>
                            <div class="col-md-8 my-2">
                                <div class="form-group">
                                    <label for="pwd">New Password</label>
                                    <input type="password" class="form-control" name="pwd" id="pwd" value="<?=set_value('pwd'); ?>" placeholder="Enter Password">
                                    <span class="text-danger"><?=isset($validation)?$validation->showError('pwd'):''; ?></span>
                                </div>
                            </div>
                            <div class="col-md-8 my-2">
                                <div class="form-group">
                                    <label for="cpwd">Confirm Password</label>
                                    <input type="password" class="form-control" name="cpwd" id="cpwd" value="<?=set_value('cpwd'); ?>" placeholder="Enter Confirm Password">
                                    <span class="text-danger"><?=isset($validation)?$validation->showError('cpwd'):''; ?></span>
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