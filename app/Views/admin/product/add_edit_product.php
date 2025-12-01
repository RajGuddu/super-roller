<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
<?php $seg2 = service('uri')->getSegment(2); ?>
<main id="main" class="main">

    <div class="pagetitle ">
        <div class="d-flex justify-content-between">
            <h1><?=$page_title?></h1>
            <a href="<?=base_url('admin/products')?>" class="btn btn-primary">Back</a>
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
                        <h5 class="card-title"><?=(isset($products) && $products->pro_id)?'Edit':'Add'?> <?=$page_title?><?=(isset($products) && $products->product_name != '')?' ('.$products->product_name.')':''?></h5>
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?=(!isset($products) || (isset($products) && $products->current_tab == 1))?'active':''?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true" onclick="update_current_tab(1,<?=isset($products)?$products->pro_id:'0'?>)">Basic</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?=(isset($products) && $products->current_tab == 2)?'active':''?>" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false" onclick="update_current_tab(2,<?=isset($products)?$products->pro_id:'0'?>)">Images & Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?=(isset($products) && $products->current_tab == 3)?'active':''?>" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false" onclick="update_current_tab(3,<?=isset($products)?$products->pro_id:'0'?>)">Attributes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?=(isset($products) && $products->current_tab == 4)?'active':''?>" id="highlights-tab" data-bs-toggle="tab" data-bs-target="#highlights" type="button" role="tab" aria-controls="highlights" aria-selected="false" onclick="update_current_tab(4,<?=isset($products)?$products->pro_id:'0'?>)">Ingredients</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?=(isset($products) && $products->current_tab == 5)?'active':''?>" id="amenities-tab" data-bs-toggle="tab" data-bs-target="#amenities" type="button" role="tab" aria-controls="amenities" aria-selected="false" onclick="update_current_tab(5,<?=isset($products)?$products->pro_id:'0'?>)">Amenities</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?=(isset($products) && $products->current_tab == 6)?'active':''?>" id="publish-tab" data-bs-toggle="tab" data-bs-target="#publish" type="button" role="tab" aria-controls="publish" aria-selected="false" onclick="update_current_tab(6,<?=isset($products)?$products->pro_id:'0'?>)">Publish</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <div class="tab-pane fade <?=(!isset($products) || (isset($products) && $products->current_tab == 1))?'show active':''?>" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- Horizontal Form -->
                                <form class="" autocomplete="off" action="<?=current_url() ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="row mb-3">
                                        <label for="product_name" class="col-sm-3 col-form-label">Product Name<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?=set_value('product_name', (isset($products->product_name))?$products->product_name:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'product_name') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="url" class="col-sm-3 col-form-label">Url</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="url" name="url" value="<?=set_value('url', (isset($products->url))?$products->url:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'url') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="short_desc" class="col-sm-3 col-form-label">Short Description<span class="text-danger">*</span> </label>
                                        <div class="col-sm-9">
                                            <textarea name="short_desc" id="short_desc" class="form-control" rows="4"><?=set_value('short_desc', (isset($products->short_desc))?$products->short_desc:''); ?></textarea>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'short_desc') : '' ?></span>
                                        </div>
                                    </div>
                                    
                                    <?php /* <div class="row mb-3">
                                        <label for="page" class="col-sm-3 col-form-label">Timeshares</label>
                                        <div class="col-sm-9">
                                            <?php if(!empty($timeshares)){
                                            foreach($timeshares as $key=>$list){ 
                                                $checked = '';
                                                if(isset($products) && $products->timeshare_ids != '' && in_array($list->id, explode(',', $products->timeshare_ids))){
                                                    $checked = 'checked';
                                                }
                                            ?>
                                            
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="timeshare<?=$key?>" name="timeshare_ids[]" value="<?=$list->id?>" <?=set_checkbox('timeshare_ids[]', $list->id).' '.$checked?>>
                                                <label class="form-check-label" for="timeshare<?=$key?>"><?=$list->name?></label>
                                            </div>
                                            
                                            <?php } } ?>
                                            <?php /* <select class="form-control" name="page" id="page">
                                                <option value="">Select Page</option>
                                                <?php if(!empty($pages)){ 
                                                    foreach($pages as $value) { 
                                                    $true = (isset($banner->page) && $banner->page == $value->id)?true:''?>
                                                    <option value="<?=$value->id ?>" <?=set_select('page', $value->id, $true)?>><?=$value->page_name ?></option>
                                                <?php  }  } ?>
                                            </select> *
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'timeshare_ids.*') : '' ?></span>
                                        </div>
                                    </div>*/ ?>
                                    
                                    <?php /* <div class="row mb-3">
                                        <label for="sub_title" class="col-sm-2 col-form-label">Banner Sub Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="sub_title" name="sub_title" value="<?=(isset($banner->sub_title))?$banner->sub_title:set_value('sub_title'); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'sub_title') : '' ?></span>
                                        </div>
                                    </div> */ ?>
                                    <div class="row mb-3">
                                        <label for="image" class="col-sm-3 col-form-label">Image for Home Page</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary me-4" onclick="imageUpload('home_image','home_image');">Upload</button>
                                                <input type="text" class="form-control" name="home_image" id="home_image" value="<?=set_value('home_image')?>" placeholder="No file choosen...">
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'home_image') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="homeimage_alt" class="col-sm-3 col-form-label">Alt Text</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="homeimage_alt" id="homeimage_alt" class="form-control" value="<?=set_value('homeimage_alt', (isset($products->homeimage_alt))?$products->homeimage_alt:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'homeimage_alt') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="homeimage_title" class="col-sm-3 col-form-label">Title Text</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="homeimage_title" id="homeimage_title" class="form-control" value="<?=set_value('homeimage_title', (isset($products->homeimage_title))?$products->homeimage_title:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'homeimage_title') : '' ?></span>
                                        </div>
                                    </div>
                                    
                                    <?php /* <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-3 pt-0">Status</legend>
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status" value="1" <?=set_radio('status', 1, TRUE)?>>
                                                <label class="form-check-label" for="status">
                                                Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($banner->status) && $banner->status == '0')?true:'')?>>
                                                <label class="form-check-label" for="status2">
                                                Inactive
                                                </label>
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                                            
                                        </div>
                                    </fieldset> */ ?>
                                    <input type="hidden" name="submit" value="basic">
                                    <input type="hidden" name="pro_id" value="<?=isset($products)?$products->pro_id:''?>">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="<?=base_url('admin/products')?>" class="btn btn-warning">Cancel</a>
                                    </div>
                                    
                                </form><!-- End Horizontal Form -->
                            </div>
                            <div class="tab-pane fade <?=(isset($products) && $products->current_tab == 2)?'show active':''?>" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form class="" autocomplete="off" action="<?=current_url() ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="row mb-3">
                                        <label for="detail_image" class="col-sm-3 col-form-label">Image for Detail Page</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary me-4" onclick="imageUpload('detail_image','detail_image');">Upload</button>
                                                <input type="text" class="form-control" name="detail_image" id="detail_image" value="<?=set_value('detail_image')?>" placeholder="No file choosen...">
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'detail_image') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="detail_image_alt" class="col-sm-3 col-form-label">Detail image Alt</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="detail_image_alt" id="detail_image_alt" class="form-control" value="<?=set_value('detail_image_alt', (isset($products->detail_image_alt))?$products->detail_image_alt:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'detail_image_alt') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="detail_image_title" class="col-sm-3 col-form-label">Detail image Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="detail_image_title" id="detail_image_title" class="form-control" value="<?=set_value('detail_image_title', (isset($products->detail_image_title))?$products->detail_image_title:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'detail_image_title') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="detail_para" class="col-sm-3 col-form-label">Detail Paragraph<span class="text-danger">*</span> </label>
                                        <div class="col-sm-9">
                                            <textarea name="detail_para" id="detail_para" class="form-control" rows="4"><?=set_value('detail_para', (isset($products->detail_para))?$products->detail_para:''); ?></textarea>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'detail_para') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="ingred_desc" class="col-sm-3 col-form-label">Ingredients Description<span class="text-danger">*</span> </label>
                                        <div class="col-sm-9">
                                            <textarea name="ingred_desc" id="ingred_desc" class="form-control" rows="4"><?=set_value('ingred_desc', (isset($products->ingred_desc))?$products->ingred_desc:''); ?></textarea>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ingred_desc') : '' ?></span>
                                        </div>
                                    </div>
                                    <?php /* 
                                    <div class="row mb-3">
                                        <label for="full_image" class="col-sm-3 col-form-label">Full Image for Detail Page</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary me-4" onclick="imageUpload('full_image','full_image');">Upload</button>
                                                <input type="text" class="form-control" name="full_image" id="full_image" value="<?=set_value('full_image')?>" placeholder="No file choosen...">
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'full_image') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="full_image_alt" class="col-sm-3 col-form-label">Full image Alt</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="full_image_alt" id="full_image_alt" class="form-control" value="<?=set_value('full_image_alt', (isset($products->full_image_alt))?$products->full_image_alt:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'full_image_alt') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="full_image_title" class="col-sm-3 col-form-label">Full image Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="full_image_title" id="full_image_title" class="form-control" value="<?=set_value('full_image_title', (isset($products->full_image_title))?$products->full_image_title:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'full_image_title') : '' ?></span>
                                        </div>
                                    </div>
                                    <p class="fw-bold">Other Images:</p>
                                    <div class="row mb-3">
                                        <label for="hotel_view_image" class="col-sm-3 col-form-label">Hotel view image</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary me-4" onclick="imageUpload('hotel_view_image','hotel_view_image');">Upload</button>
                                                <input type="text" class="form-control" name="hotel_view_image" id="hotel_view_image" value="<?=set_value('hotel_view_image')?>" placeholder="No file choosen...">
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'hotel_view_image') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="guest_room_image" class="col-sm-3 col-form-label">Guest Room Image</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary me-4" onclick="imageUpload('guest_room_image','guest_room_image');">Upload</button>
                                                <input type="text" class="form-control" name="guest_room_image" id="guest_room_image" value="<?=set_value('guest_room_image')?>" placeholder="No file choosen...">
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'guest_room_image') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fitness_image" class="col-sm-3 col-form-label">Fitness Image</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary me-4" onclick="imageUpload('fitness_image','fitness_image');">Upload</button>
                                                <input type="text" class="form-control" name="fitness_image" id="fitness_image" value="<?=set_value('fitness_image')?>" placeholder="No file choosen...">
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'fitness_image') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="dining_image" class="col-sm-3 col-form-label">Dining Image</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary me-4" onclick="imageUpload('dining_image','dining_image');">Upload</button>
                                                <input type="text" class="form-control" name="dining_image" id="dining_image" value="<?=set_value('dining_image')?>" placeholder="No file choosen...">
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dining_image') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="activities_image" class="col-sm-3 col-form-label">Activities Image</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary me-4" onclick="imageUpload('activities_image','activities_image');">Upload</button>
                                                <input type="text" class="form-control" name="activities_image" id="activities_image" value="<?=set_value('activities_image')?>" placeholder="No file choosen...">
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'activities_image') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="spa_image" class="col-sm-3 col-form-label">Spa Image</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary me-4" onclick="imageUpload('spa_image','spa_image');">Upload</button>
                                                <input type="text" class="form-control" name="spa_image" id="spa_image" value="<?=set_value('spa_image')?>" placeholder="No file choosen...">
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'spa_image') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="des_beside_calender" class="col-sm-3 col-form-label">Description Beside Calender </label>
                                        <div class="col-sm-9">
                                            <textarea name="des_beside_calender" id="des_beside_calender" class="form-control" rows="4"><?=set_value('des_beside_calender', (isset($products->des_beside_calender))?$products->des_beside_calender:''); ?></textarea>
                                            <script>
                                                var oEdit1 = new InnovaEditor("oEdit1");					
                                                oEdit1.width='100%';
                                                oEdit1.height=400;			
                                                oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                                                oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                                                oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                                                oEdit1.onSave = new Function("submitEditContentForm()");
                                                oEdit1.REPLACE("des_beside_calender");		
                                                oEdit1.mode="XHTMLBody";
                                            </script>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'des_beside_calender') : '' ?></span>
                                        </div>
                                    </div>*/ ?>

                                    <input type="hidden" name="submit" value="Images">
                                    <input type="hidden" name="pro_id" value="<?=isset($products)?$products->pro_id:''?>">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="<?=base_url('admin/products')?>" class="btn btn-warning">Cancel</a>
                                    </div>
                                    
                                </form><!-- End Horizontal Form -->
                            </div>
                            <div class="tab-pane fade <?=(isset($products) && $products->current_tab == 3)?'show active':''?>" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                                <form class="" autocomplete="off" action="<?=current_url() ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <table class="table table-dark my-2">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Attribute Value</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">MRP</th>
                                                <th scope="col">SP</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($attributes)){ $sn=1;
                                                foreach($attributes as $list){ ?>
                                                    <tr>
                                                        <td><?=$sn++; ?></td>
                                                        <td><?=$list->attr_value?></td>
                                                        <td><?=$list->unit?></td>
                                                        <td><?=$list->mrp?></td>
                                                        <td><?=$list->sp?></td>
                                                        <td><?=$list->stock?></td>
                                                        <td><?=($list->status)?'<span class="badge bg-success">Active</span>':'<span class="badge bg-warning">InActive</span>'?></td>
                                                        <td>
                                                            <a href="<?=base_url('admin/product_cu/'.$products->pro_id.'/'.$list->attr_id)?>" class="btn btn-outline-info"><i class="bi bi-pencil-square"></i></a>
                                                            <?php /* <a href="<?=base_url('admin/room_d/'.$products->pro_id.'/'.$list->attr_id)?>" class="btn btn-outline-info" onclick="return confirm('Are You Sure?')"><i class="bi bi-trash" style="color:red"></i></a> */ ?>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            }else{
                                                echo '<tr><td colspan="7" class="text-danger text-center">No Features</td></tr>';
                                            } ?>
                                        </tbody>

                                    </table>
                                    <div class="d-flex justify-content-between my-3">
                                        <h5 class="fw-bold "><?=isset($attribute)?'Edit':'Add'?> Attributes </h5>
                                        <?php if(isset($attribute)){ ?>
                                        <a href="<?=base_url('admin/product_cu/'.$products->pro_id)?>" class="btn btn-primary btn-sm">Add/Reset</a>
                                        <?php } ?>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="attr_value" class="col-sm-3 col-form-label">Attribute Value<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="attr_value" id="attr_value" class="form-control" value="<?=set_value('attr_value', (isset($attribute->attr_value))?$attribute->attr_value:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'attr_value') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="unit_id" class="col-sm-3 col-form-label">Unit<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">

                                            <select class="form-control" name="unit_id" id="unit_id">
                                                <option value="">Select Unit</option>
                                                <?php if(!empty($units)){ 
                                                    foreach($units as $value) { 
                                                    $true = (isset($attribute->unit_id) && $attribute->unit_id == $value->id)?true:''?>
                                                    <option value="<?=$value->id ?>" <?=set_select('unit_id', $value->id, $true)?>><?=$value->unit ?></option>
                                                <?php  }  } ?>
                                            </select>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'unit_id') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="mrp" class="col-sm-3 col-form-label">MRP<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mrp" id="mrp" class="form-control" value="<?=set_value('mrp', (isset($attribute->mrp))?$attribute->mrp:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'mrp') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="sp" class="col-sm-3 col-form-label">SP<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sp" id="sp" class="form-control" value="<?=set_value('sp', (isset($attribute->sp))?$attribute->sp:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'sp') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="stock" class="col-sm-3 col-form-label">Stock<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="stock" id="stock" class="form-control" value="<?=set_value('stock', (isset($attribute->stock))?$attribute->stock:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'stock') : '' ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
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
                                                    <input class="form-check-input" type="radio" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($attribute->status) && $attribute->status < 1)?true:'')?>>
                                                    <label class="form-check-label" for="status2">
                                                    Inactive
                                                    </label>
                                                </div>
                                                <span class="text-danger"></span>
                                                
                                            </div>
                                        </fieldset>
                                    </div>

                                    <input type="hidden" name="submit" value="room-features">
                                    <input type="hidden" name="pro_id" value="<?=isset($products)?$products->pro_id:''?>">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="<?=base_url('admin/products')?>" class="btn btn-warning">Cancel</a>
                                    </div>
                                    
                                </form><!-- End Horizontal Form -->
                            </div>
                            <div class="tab-pane fade <?=(isset($products) && $products->current_tab == 4)?'show active':''?>" id="highlights" role="tabpanel" aria-labelledby="highlights-tab">
                                <form class="" autocomplete="off" action="<?=current_url() ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="row mb-3">
                                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="title" name="title" value="<?=set_value('title')?>" >
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'title.*') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="sub_title" class="col-sm-2 col-form-label">Sub-Title</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="sub_title" name="sub_title" value="<?=set_value('sub_title')?>" >
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'sub_title.*') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="details" class="col-sm-2 col-form-label">Details</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="details" name="details" rows="5"><?=set_value('title')?></textarea>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'title.*') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mb-3">
                                        <button type="button" class="btn btn-success">Add</button>
                                    </div>
                                    
                                    <input type="hidden" name="submit" value="highlights">
                                    <input type="hidden" name="pro_id" value="<?=isset($resort)?$resort->pro_id:''?>">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="<?=base_url('admin/resort')?>" class="btn btn-warning">Cancel</a>
                                    </div>
                                    
                                </form><!-- End Horizontal Form -->
                            </div>
                            <div class="tab-pane fade <?=(isset($resort) && $resort->current_tab == 5)?'show active':''?>" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
                                <form class="" autocomplete="off" action="<?=current_url() ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="row mb-3">
                                        <label for="page" class="col-sm-3 col-form-label">Amenities</label>
                                        <div class="col-sm-9">
                                            <?php if(!empty($amenities)){
                                            foreach($amenities as $key=>$list){ 
                                                $checked = '';
                                                if(isset($resort) && $resort->amenities_ids != '' && in_array($list->am_id, explode(',', $resort->amenities_ids))){
                                                    $checked = 'checked';
                                                }
                                            ?>
                                            
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="amenities<?=$key?>" name="amenities_ids[]" value="<?=$list->am_id?>" <?=set_checkbox('amenities_ids[]', $list->am_id).' '.$checked?>>
                                                <label class="form-check-label" for="amenities<?=$key?>"><?=$list->name?></label>
                                            </div>
                                            
                                            <?php } } ?>
                                            
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'amenities_ids.*') : '' ?></span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="submit" value="amenities">
                                    <input type="hidden" name="pro_id" value="<?=isset($resort)?$resort->pro_id:''?>">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="<?=base_url('admin/resort')?>" class="btn btn-warning">Cancel</a>
                                    </div>
                                    
                                </form><!-- End Horizontal Form -->
                            </div>
                            <div class="tab-pane fade <?=(isset($resort) && $resort->current_tab == 6)?'show active':''?>" id="publish" role="tabpanel" aria-labelledby="publish-tab">
                                <form class="" autocomplete="off" action="<?=current_url() ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="row mb-3">
                                        <label for="map_address" class="col-sm-3 col-form-label">Map Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="map_address" name="map_address" value="<?=set_value('map_address', (isset($resort->map_address))?$resort->map_address:''); ?>">
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'map_address') : '' ?></span>
                                        </div>
                                    </div>
                                    <p class="fw-bold text-center text-danger">Or</p>
                                    <div class="row mb-3">
                                        <label for="map_image" class="col-sm-3 col-form-label">Map Image</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-primary me-4" onclick="imageUpload('map_image','map_image');">Upload</button>
                                                <input type="text" class="form-control" name="map_image" id="map_image" value="<?=set_value('map_image')?>" placeholder="No file choosen...">
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'map_image') : '' ?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="is_popular" class="col-sm-3 col-form-label">Popular?</label>
                                        <div class="col-sm-9">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="is_popular" name="is_popular" value="1" <?=set_checkbox('is_popular', 1, (isset($resort->is_popular) && $resort->is_popular == 1)?true:'')?>>
                                                <label class="form-check-label" for="is_popular">Yes</label>
                                            </div>
                                        </div>
                                    </div>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-3 pt-0">Status</legend>
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status" value="1" <?=set_radio('status', 1, TRUE)?>>
                                                <label class="form-check-label" for="status">
                                                Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($resort->status) && $resort->status < 1)?true:'')?>>
                                                <label class="form-check-label" for="status2">
                                                Inactive
                                                </label>
                                            </div>
                                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'amenities_ids.*') : '' ?></span>
                                            
                                        </div>
                                    </fieldset>
                                        
                                    <input type="hidden" name="submit" value="publish">
                                    <input type="hidden" name="pro_id" value="<?=isset($resort)?$resort->pro_id:''?>">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <a href="<?=base_url('admin/resort')?>" class="btn btn-warning">Cancel</a>
                                    </div>
                                    
                                </form><!-- End Horizontal Form -->
                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>
            </div>

            <?php if(isset($products) && $products->pro_id){ ?>
            
            <div class="col-lg-5">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="card-title">Uploaded Image</h5>
                        <?php $is_image = 0; ?>
                        <div class="d-flex align-content-start flex-wrap my-2">
                            <?php if($products->home_image != ''){ $is_image = 1; ?>
                            <div class="img-box my-2">
                                <span class="cancel-icon" onclick="cancel_image('tbl_product','home_image','pro_id',<?=$products->pro_id?>);"><i class="bi bi-x-lg" style="font-size: 36px;" title="Cancel Image"></i></span>
                                <img src="<?=base_url(FILE_UPLOAD_PATH.$products->home_image)?>" class="" alt="..." >
                                <small class="image-title">Image for Home Page</small>
                            </div>
                            <?php } ?>
                            
                            <?php if($products->detail_image != ''){ $is_image = 1; ?>
                            <div class="img-box">
                                <span class="cancel-icon" onclick="cancel_image('tbl_product','detail_image','pro_id',<?=$products->pro_id?>);"><i class="bi bi-x-lg" style="font-size: 36px;" title="Cancel Image"></i></span>
                                <img src="<?=base_url(FILE_UPLOAD_PATH.$products->detail_image)?>" class="" alt="..." >
                                <small class="image-title">Image for Detail Page</small>
                            </div>
                            <?php } ?>
                            
                        </div>
                        <?php if(! $is_image){ 
                            echo '<p class="text-danger text-center">No Image upload</p>';
                        }  ?>
                        <?php /* if($resort->home_image == ''){ ?>
                        <img src="<?=base_url(FILE_UPLOAD_PATH.$resort->home_image)?>" class="card-img-top" alt="..." height="300px" width="100%">
                        <div class="d-flex justify-content-between my-2">
                            <h5 class="text-dark">Banner image</h5>
                            <a href="<?=base_url('admin/remove_banner_image/'.$resort->pro_id)?>" class="btn btn-outline-danger" onclick="return confirm('Are u sure?')" title="Remove Image"><i class="bi bi-trash"></i></a>
                        </div>
                        <?php }else{
                            echo '<p class="text-danger text-center">No Image upload</p>';
                        } */ ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

</main><!-- End #main -->

<script>
    function update_current_tab(tabno, pro_id){
        if(tabno){
            $.ajax({
                type: 'post',
                url: '<?=base_url('admin/update_current_tab'); ?>',
                data: {tabno:tabno, pro_id:pro_id},
                success: function(res){
                    console.log(res);
                    return true;
                }
            })
        }else{
            return false;
        }
    }
    /*var secno = 2;
    function add_section(){
        
        var sectionHtml = '<div class="card cardsection">'+
                            '<div class="card-body">'+
                                '<h5 class="card-title">Date '+ secno +'</h5>'+
                                    '<div class="row mb-1">'+
                                        '<div class="col-sm-12">'+
                                            '<label for="">Price</label>'+
                                            '<input type="text" name="price[]" id="price" value="" class="form-control">'+
                                        '</div>'+
                                        '<div class="col-sm-6">'+
                                            '<label for="">Date From</label>'+
                                            '<input type="date" name="date_from[]" id="date_from" value="" class="form-control">'+
                                        '</div>'+
                                        '<div class="col-sm-6">'+
                                            '<label for="">Date To</label>'+
                                            '<input type="date" name="date_to[]" id="date_to" value="" class="form-control">'+
                                        '</div>'+
                                        '<div class="text-center my-2">'+
                                            '<button type="button" class="btn btn-success me-2" onclick="add_section()">Add</button>'+
                                            '<button type="button" class="btn btn-danger removecardsection">Remove</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>' +
                            '</div>';

        $("#calender").append(sectionHtml);
        secno++;
    }
    $("#calender").on("click", ".removecardsection", function() {
        var isConfirmed = confirm("Are you sure?");
        if (isConfirmed) {
            $(this).closest(".cardsection").remove();
        }
    });*/
</script>
<script>
    $("body").on("keyup","#product_name", function(event){	
        var urlval = $(this).val();
        var newurl = urlval.replace(/[_\s]/g, '-').replace(/[^a-z0-9-\s]/gi, '');
        $('#url').val(newurl.toLowerCase());
    });
</script>

<?=$this->endSection()?>