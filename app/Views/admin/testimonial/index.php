<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php $seg2 = service('uri')->getSegment(2); ?>
    <main id="main" class="main">

        <div class="pagetitle ">
          <div class="d-flex justify-content-between">
            <h1>Testimonial</h1>
            <a href="<?=base_url('admin/add_edit_testimonial')?>" class="btn btn-primary">Add Testimonial</a>
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
                    <!-- <th>Logo</th> -->
                    <th>Name</th>
                    <th>Description</th>
                    <!-- <th>Post</th> -->
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php if(!empty($testimonial)){
                $sn=1;
                foreach($testimonial as $list){ ?>
                <tr>
                    <td><?=$sn++?></td>
                    <?php /* <td>
                        <img alt="image" src="<?=($list->logo != '')?base_url('public/assets/upload/images/'.$list->logo):base_url('public/assets/upload/images/dummy2.png')?>" class="gdimage"/>
                    </td> */ ?>
                    <td><?=$list->name?></td>
                    <td><?=substr($list->description,0,50).'...'?></td>
                    <?php /* <td><?=$list->post?></td> */ ?>
                    <td>
                        <?=($list->status==1)?'<span class="badge bg-success">Active</span>':'<span class="badge bg-warning">InActive</span>'?>
                    </td>
                    <td width="200">
                        <a href="<?= base_url('/admin/add_edit_testimonial/'.$list->id) ?>" class="btn btn-outline-info"><i class="bi bi-pencil-square"></i></a>
                        <!--<a href="<?= base_url('/admin/users/view_one/'.$list->id) ?>"><i class="far fa-eye"></i></a>-->
                        <a href="<?= base_url('/admin/delete_testimonial/'.$list->id) ?>" onclick="return confirm('Are you sure?')"  class="btn btn-outline-info" style="color:red"><i class="bi bi-trash"></i></a>
                        
                    </td>
                </tr>
                <?php } } else { ?>
                    <tr><td colspan="5">No Data Available</td></tr>
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