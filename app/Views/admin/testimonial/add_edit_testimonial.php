<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php $seg2 = service('uri')->getSegment(2); ?>
<main id="main" class="main">

    <div class="pagetitle ">
        <div class="d-flex justify-content-between">
            <h1>Testimonial</h1>
            <a href="<?=base_url('admin/testimonial')?>" class="btn btn-primary">Back</a>
        </div>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url('/admin')?>">Admin</a></li>
            <li class="breadcrumb-item active"><?=$seg2?></li>
            </ol>
        </nav>
        <?php if(session()->getFlashdata('message') !== NULL){
            echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
        } ?>
    </div><!-- End Page Title -->

    <section class="section ">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?=(isset($testimonial) && $testimonial->id)?'Edit':'Add'?> Testimonial</h5>

                        <!-- Horizontal Form -->
                        <form class="" autocomplete="off" action="<?=current_url() ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="<?=(isset($testimonial->name))?$testimonial->name:set_value('name'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" rows="7" cols="50"><?=(isset($testimonial->description))?$testimonial->description:set_value('description'); ?></textarea>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary me-4" onclick="imageUpload('logo','logo');">Upload</button>
                                    <input type="text" class="form-control" name="logo" id="logo" value="<?=set_value('logo')?>" placeholder="No file choosen...">
                                </div>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="post" class="col-sm-2 col-form-label">Position</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="post" name="post" value="<?=(isset($testimonial->post))?$testimonial->post:set_value('post'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'post') : '' ?></span>
                            </div>
                        </div>
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status" value="1" <?=set_radio('status', 1, TRUE)?>>
                                    <label class="form-check-label" for="status">
                                    Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($testimonial->status) && $testimonial->status == '0')?true:'')?>>
                                    <label class="form-check-label" for="status2">
                                    Inactive
                                    </label>
                                </div>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                                
                            </div>
                        </fieldset>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="<?=base_url('admin/testimonial')?>" class="btn btn-warning">Cancel</a>
                        </div>
                        </form><!-- End Horizontal Form -->

                    </div>
                </div>
            </div>

            <?php if(isset($testimonial) && $testimonial->id){ ?>
            <div class="col-lg-5">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="card-title">Uploaded Image</h5>
                        <?php if($testimonial->logo != ''){ ?>
                        <img src="<?=base_url(FILE_UPLOAD_PATH.$testimonial->logo)?>" class="card-img-top" alt="..." height="300px" width="100%">
                        <div class="d-flex justify-content-between my-2">
                            <h5 class="text-dark">Testimonial image</h5>
                            <a href="<?=base_url('admin/remove_testimonial_image/'.$testimonial->id)?>" class="btn btn-outline-danger" onclick="return confirm('Are u sure?')" title="Remove Image"><i class="bi bi-trash"></i></a>
                        </div>
                        <?php }else{
                            echo '<p class="text-danger text-center">No Image upload</p>';
                        } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

</main><!-- End #main -->

<?=$this->endSection()?>