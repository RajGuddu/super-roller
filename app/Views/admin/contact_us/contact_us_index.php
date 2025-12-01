<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php $seg2 = service('uri')->getSegment(2); ?>
    <main id="main" class="main">

        <div class="pagetitle ">
          <div class="d-flex justify-content-between">
            <h1><?=$title?></h1>
            <?php /* <a href="<?=base_url('admin/add_edit_testimonial')?>" class="btn btn-primary">Add Testimonial</a>*/ ?>
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
                    <th>Name</th>
                    <th>Country</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php if(!empty($listing)){
                $sn=1;
                foreach($listing as $list){ ?>
                <tr>
                    <td><?=$sn++?></td>
                    <?php /* <td>
                        <img alt="image" src="<?=($list->logo != '')?base_url('public/assets/upload/images/'.$list->logo):base_url('public/assets/upload/images/dummy2.png')?>" class="gdimage"/>
                    </td> */ ?>
                    <td><?=$list->name?></td>
                    <td><?=$list->countries_name?></td>
                    <td><?=$list->email?></td>
                    <td><?=$list->phone?></td>
                    <td>
                        <?=($list->status==1)?'<span class="badge bg-success">New</span>':'<span class="badge bg-warning">Old</span>'?>
                    </td>
                    <td width="200">
                      <a href="javascript:void(0)" class="btn btn-outline-info " onclick="change_status(<?=$list->id?>,<?=$list->status?>)">Change Status</i></a>
                      <?php /* <a href="javascript:void(0)" class="btn btn-outline-info"><i class="bi bi-pencil-square"></i></a>
                        <a href="<?= base_url('/admin/users/view_one/'.$list->id) ?>"><i class="far fa-eye"></i></a>
                        <a href="<?= base_url('/admin/delete_testimonial/'.$list->id) ?>" onclick="return confirm('Are you sure?')"  class="btn btn-outline-info" style="color:red"><i class="bi bi-trash"></i></a> */ ?>
                        
                    </td>
                </tr>
                <?php } } else { ?>
                    <tr><td colspan="7">No Data Available</td></tr>
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

    <div class="modal fade" id="change-status-modal" tabindex="-1" data-bs-backdrop="false" style="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-light">
            <h5 class="modal-title">Change Status</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?=current_url(); ?>" method="post">
          <?=csrf_field(); ?>
          <input type="hidden" name="id" id="c_id" value="">
          <div class="modal-body">
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" value="1" >
                        <label class="form-check-label" for="status1">
                        New
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" value="2" >
                        <label class="form-check-label" for="status2">
                        Old
                        </label>
                    </div>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                    
                </div>
            </fieldset>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      function change_status(id, status){
        $("#c_id").val(id);
        $("#status"+status).prop("checked", true);
        $("#change-status-modal").modal('show');
      }
    </script>

<?=$this->endSection()?>