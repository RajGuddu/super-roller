<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Testimonial</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('/admin')?>">Dashboard</a></li>
                <li class="breadcrumb-item active">testimonial</li>
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
                    <form class="" autocomplete="off" action="<?=current_url() ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group my-2">
                            <label for="name" >Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=(isset($testimonial->name))?$testimonial->name:set_value('name'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                        </div>
                        <div class="form-group my-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="7" cols="50"><?=(isset($testimonial->description))?$testimonial->description:set_value('description'); ?></textarea>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
                        </div>
                        <div class="row">
                            <?php if(isset($testimonial->logo) && $testimonial->logo != ''){ ?>
                                <div class="col-md-6">
                                    <img src="<?=base_url('public/assets/upload/images/'.$testimonial->logo) ?>" class="gdimage" />
                                </div>
                            <?php } ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" id="logo" name="logo">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'logo') : '' ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  my-2">
                            <label for="post">Position</label>
                            <input type="text" class="form-control" id="post" name="post" value="<?=(isset($testimonial->post))?$testimonial->post:set_value('post'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'post') : '' ?></span>
                        </div>
                        <div class="form-group  my-2">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($testimonial->status) && $testimonial->status == '1')?true:'')?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($testimonial->status) && $testimonial->status == '0')?true:'')?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-info">Reset</button>
                        <a href="<?=base_url('admin/testimonial')?>" class="btn btn-warning">Cancel</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?=$this->endSection()?>