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
                    
                    <table id="datatablesSimple">
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
                                    <?=($list->status==1)?'<span class="btn btn-success btn-sm">Active</span>':'<span class="btn btn-warning btn-sm">InActive</span>'?>
                                </td>
                                <td width="200">
                                    <a href="<?= base_url('/admin/add_edit_testimonial/'.$list->id) ?>" class="btn btn-outline-info"><i class="far fa-edit"></i></a>
                                    <!--<a href="<?= base_url('/admin/users/view_one/'.$list->id) ?>"><i class="far fa-eye"></i></a>-->
                                    <a href="<?= base_url('/admin/delete_testimonial/'.$list->id) ?>" onclick="return confirm('Are you sure?')"  class="btn btn-outline-info" style="color:red"><i class="fas fa-trash"></i></a>
                                    
                                </td>
                            </tr>
                            <?php } } else { ?>
                                <tr><td colspan="5">No Data Available</td></tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                        
                </div>
            </div>
        </div>
    </main>

    <?=$this->endSection()?>