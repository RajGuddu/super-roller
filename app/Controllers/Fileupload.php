<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
class Fileupload extends BaseController
{
    public function __construct()
    {
        helper(['file']);
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->adminmodel = model('App\Models\Admin_model', false);
    }
    /***************************Image upload popup*********************** */
    public function image_upload_show_modal(){
        $imageUploadUrl = base_url('common_image_upload');
        $imageGallaryUrl = base_url('get_image_gallary_by_ajax');
        $deleteImageUrl = base_url('delete_image_by_ajax');
        $imagename = (isset($_POST['imagename']))?$_POST['imagename']:'' ;
        $outputElemId = (isset($_POST['outputId']))?$_POST['outputId']:'' ;
        $imageGallary = $this->get_image_gallary();
        $bodypart = 
        '<div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="imageUploadLabel" > Image Upload</h5>
            <a href="javascript:void(0)" class="imageUploadModalClose text-white" onclick="closeModal();"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
        <div class="modal-body" style="height:500px;" >
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <!-- <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" onclick="show_hide_select_btn();">Upload Files</a> -->

                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="show_hide_select_btn();">Upload Files</button>
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="show_hide_select_btn();">Media Library</a> -->

                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" tabindex="-1" onclick="show_hide_select_btn();">Media Library</button>
                </li>
            
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="d-flex justify-content-center">
                        <form action="" method="post" id="uploadImageForm" enctype="multipart/form-data">
                            <input type="file" name="image" id="" class="">
                            <input type="hidden" name="imagename" value="'.$imagename.'">
                            <button type="button" class="btn btn-primary" id="uploadImageBtn">Upload</button>
                        </form>
                    </div>
                    <span class="text-danger" id="imageErr"></span> 
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="">
                        <!-- <form action="" method="post"> -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="search" id="searchTextBox" value="" placeholder="Search Image" onkeyup="getSearchedImage();">
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="javascript:void(0);" class="btn btn-danger" onclick="deleteImage();">Delete</a>
                            </div>
                        </div>


                    </div>
                    <div id="imageGallary">
                        '.$imageGallary.'
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary imageUploadModalClose" onclick="closeModal();">Close</button>
            <button type="button" class="btn btn-primary d-none" id="selectBtn" onclick="final_selection_image_media();">Select</button>
        </div>';
        
        $script = '<script type="text/javascript">
                        function closeModal(){
                            $("#imageUploadModal").modal("hide");
                        }
                        $("#uploadImageBtn").click(function(){
                            var form = $("#uploadImageForm");
                            var formData = new FormData(form[0]);
                            $("#imageErr").html("");
                            $.ajax({
                                type: "POST",
                                url: "'.$imageUploadUrl.'",
                                data: formData,
                                processData: false,
                                contentType: false,
                                dataType: "json",
                                beforeSend: function() {
                                    $("#uploadImageBtn").html("uploading...");
                                    $("#uploadImageBtn").attr("disabled", true);
                                },
                                success: function(res){
                                    console.log(res);
                                    $("#uploadImageBtn").html("Upload");
                                    $("#uploadImageBtn").removeAttr("disabled");
                                    if(res.error != undefined && res.error == true){
                                        $("#imageErr").html(res.msg);
                                    }
                                    else if(res.error != undefined && res.error == false){
                                        form[0].reset();
                                        get_image_gallary();
                                        $("#pills-home-tab").removeClass("active");
                                        $("#pills-home").removeClass("show active");
                                        $("#pills-profile-tab").addClass("active");
                                        $("#pills-profile").addClass("show active");
                                        $("#selectBtn").removeClass("d-none");
                                    }
                                }
                            });
                        });

                        function get_image_gallary(from="", to="", searchText=""){
                           
                            $.ajax({
                                type: "POST",
                                url: "'.$imageGallaryUrl.'",
                                data: {from:from, to:to, searchText:searchText},
                                success: function(res){
                                    console.log(res);
                                    $("#imageGallary").html(res);
                                }
                            });
                        }

                        function loadMore(from, to){
                            var searchText = $("#searchTextBox").val();
                            get_image_gallary(from, to, searchText);
                        }

                        function getSearchedImage(){
                            var searchText = $("#searchTextBox").val();
                            get_image_gallary("", "", searchText);
                        }

                        function show_hide_select_btn(){
                            $("#selectBtn").toggleClass("d-none");
                        }

                        function final_selection_image_media(){
                            var final_image_name = $("input[name=popupiamge]:checked").val();
                            $("#'.$outputElemId.'").val(final_image_name);
                            closeModal();
                        }

                        function deleteImage(){
                            if(confirm("Are you sure?")){
                                var searchText = $("#searchTextBox").val();
                                var image_name = $("input[name=popupiamge]:checked").val();
                                $.ajax({
                                    type: "POST",
                                    url: "'.$deleteImageUrl.'",
                                    data: {image_name:image_name},
                                    dataType: "json",
                                    success: function(res){
                                        console.log(res);
                                        if(res.error != undefined && res.error == true){
                                            alert(res.msg);
                                        }else{
                                            get_image_gallary("", "", searchText);
                                        }
                                    }
                                });
                            }
                        }
                        
                    </script>';
        echo $bodypart.$script;
        
        exit;
    }
    public function get_image_gallary($from=null, $to=null, $searchText=null){
        helper('filesystem');
        // $map = directory_map('./public/uploads', 1);
        $imageGallary = '<p class="text-danger text-center">No Image Available</p>';
        $loadMore =  '';
        $map = get_dir_file_info(FILE_UPLOAD_PATH);
        if(!empty($map)){
            
            $newmapArr = array();
            foreach($map as $key=>$list){
                $f = explode('.', $key);
                
                if(end($f) == 'webp' || end($f) == 'jpg'){
                    if($searchText != null){
                        $pattern = "/$searchText/i";
                        if(preg_match($pattern, $key)){
                            $newmapArr[] = array(
                                'date' => $list['date'],
                                'filename' => $key,
                            );
                        }
                    }else{
                        $newmapArr[] = array(
                            'date' => $list['date'],
                            'filename' => $key,
                        );
                    }
                }
                
            }
            arsort($newmapArr);
            $newmapArr = array_values($newmapArr); 
            $totalImage = count($newmapArr);
            // echo '<pre>'; print_r($newmapArr); exit;
            $imageList = '<div class="d-flex justify-content-between flex-wrap">';
            $count = 0;
            $limit = 20;
            if($limit > $totalImage){
                $limit = $totalImage;
            }
            if($from == null && $to == null){
                $from = 1; 
                $to = $limit;
            }
            
            for($i=$from-1; $i<$to; $i++){
                // if($count > 19){
                //     break;
                // }
                $checked = '';
                if($count < 1){
                    $checked = 'checked';
                }
                $PATH = base_url(FILE_UPLOAD_PATH.$newmapArr[$i]['filename']);
                $imageList .=   '<div class="form-check">
                                    <input class="form-check-input" type="radio" name="popupiamge" id="exampleRadios'.$i.'" value="'.$newmapArr[$i]['filename'].'" '.$checked.'>
                                    <label class="form-check-label" for="exampleRadios'.$i.'">
                                        <img src="'.$PATH.'" width="50px" height="50px">
                                    </label>
                                </div>';
                
                $count++;
            }
            
            $imageList .= '</div>';
            if($totalImage > $limit){
                if($to < $totalImage){
                    $nextFrom = $to + 1;
                    $nextTo = $to + $limit;
                    if($nextTo > $totalImage){
                        $nextTo = $totalImage;
                    }
                }else{
                    $nextFrom = 1;
                    $nextTo = $limit;
                }
                
                $loadMore .= '<div class="mt-4 text-center">
                                    <p class="text-primary">Showing '.$from.'-'.$to.' of '.$totalImage.' media items</p>
                                    <p class="mt-2"><a href="javascript:void(0);" class="btn btn-primary" onclick="loadMore('.$nextFrom.','.$nextTo.');" >Load More</a></p>
                                </div>';
            }
            $imageGallary = $imageList.$loadMore;
            if($totalImage < 1){
                $imageGallary = '<p class="text-danger text-center">No Image Available</p>';
            }
        }
        return $imageGallary;
        // exit;
    }
    public function get_image_gallary_by_ajax(){
        $from = (isset($_POST['from']) && $_POST['from'] != '')?$_POST['from']:'';
        $to = (isset($_POST['to']) && $_POST['to'] != '')?$_POST['to']:'';
        $searchText = (isset($_POST['searchText']) && $_POST['searchText'] != '')?$_POST['searchText']:'';
        echo $this->get_image_gallary($from, $to, $searchText);
        exit;
    }
    public function common_image_upload(){
        $result = array();
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''){
            // $imagename = $_POST['imagename'];
            $imagename = $_FILES['image']['name'];
            $imagenameArr = explode('.', $imagename);
            $imagename = $imagenameArr[0];
            $imagename = str_replace(' ','_', $imagename);
            $newFile = $imagename.'.webp';
            $error = $_FILES['image']['error'];
            $tmp_name = $_FILES['image']['tmp_name'];
    
            $uploadFile = upload_file($error, $tmp_name, $newFile);
            // echo json_encode($uploadFile);
            // exit;
            if($uploadFile['status'] != 200){
                $result['error'] = true;
                $result['msg'] = 'Image upload failed';
            }else{
                $result['error'] = false;
                $result['msg'] = 'success';
            }
        }else{
            $result['error'] = true;
            $result['msg'] = 'Please select image first!';
        }
        echo json_encode($result);
        exit;
    }
    public function delete_image_by_ajax(){
        $result = array(
            'error' => true,
            'msg' => 'Image Not Delete',
        );
        if($this->request->getMethod() == 'post'){
            $filename = $_POST['image_name'];
            $path = FILE_UPLOAD_PATH . $filename;
            if (file_exists($path)) {
                if(unlink($path)){
                    $result = array(
                        'error' => false,
                        'msg' => 'success',
                    );
                }

            }
        }
        echo json_encode($result);
        exit;
    }

    /***************************End of Image upload popup*********************** */
}