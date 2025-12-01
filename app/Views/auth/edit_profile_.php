<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?=session('name')?>'s Profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('/admin')?>">Dashboard</a></li>
                <li class="breadcrumb-item active">profile</li>
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
                    <form class="" autocomplete="off" action="<?=base_url('/profile'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label>Profile Image</label> <br>
                                    <img src="<?=base_url('public/assets/upload/users/'.$profile->image); ?>" alt="profile image" height="80px" length="70px">
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label >Change Profile Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'image') : '' ?></span>
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="name" >Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?=set_value('name', isset($profile)?$profile->name:''); ?>" placeholder="Enter Username">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email', $profile->email); ?>" placeholder="Enter email">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?=set_value('phone', $profile->phone); ?>" placeholder="Enter Phone Number">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>  
                                </div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div class="form-group ">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address', $profile->address); ?>" placeholder="Enter Address">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'address') : '' ?></span>  
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