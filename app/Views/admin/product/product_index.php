<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php $seg2 = service('uri')->getSegment(2); ?>
    <main id="main" class="main">

        <div class="pagetitle ">
          <div class="d-flex justify-content-between">
            <h1><?=$page_title?></h1>
            <a href="<?=base_url('admin/product_cu')?>" class="btn btn-primary">Add Product</a>
          </div>
          <nav>
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=base_url('/admin')?>">Admin</a></li>
              <li class="breadcrumb-item active"><?=$seg2?></li>
              </ol>
          </nav>
          
        </div><!-- End Page Title -->

        <section class="section ">
        <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                <?php if(session()->getFlashdata('message') !== NULL){
                    echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                } ?>
                </h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <!-- <th>Page For</th> -->
                    <!--<th>Url</th>-->
                    <!-- <th>Brochure</th> -->
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php if(!empty($products)){
                    $sn=1;
                    foreach($products as $list){ ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><?=$list->product_name?></td>
                        <td>
                            <img alt="image" src="<?=($list->home_image != '')?base_url('public/assets/upload/images/'.$list->home_image):base_url('public/assets/upload/images/dummy.png')?>" weight="100px" height="80"/>
                        </td>
                        <td><?=($list->status==1)?'<span class="badge bg-success">Active</span>':'<span class="badge bg-warning">InActive</span>'?></td>
                        <td>
                            <a href="<?= base_url('/admin/resort_cu/'.$list->pro_id) ?>" class="btn btn-outline-info"><i class="bi bi-pencil-square"></i></a>
                            <a href="<?= base_url('/admin/delete_resort/'.$list->pro_id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" style="color:red"><i class="bi bi-trash"></i></a>
                            
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="6" class="text-center text-danger">No Data Available</td></tr>
                    <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
        </section>

    </main><!-- End #main -->

<?=$this->endSection()?>