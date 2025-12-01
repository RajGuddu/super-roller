<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
class Admin extends BaseController
{
    public function __construct()
    {
        $this->data['title'] = 'Admin-Users';
        $this->commonmodel = model('App\Models\Common_model', false);
        $this->adminmodel = model('App\Models\Admin_model', false);
    }
    
    public function index()
    {
        //$this->data['users'] = $this->commonmodel->getAllRecord('tbl_admin');
        return view("admin/dashboard",$this->data);
        
    }

    /*******************************************Settings************************************** */
    public function setting()
    {
        if ($this->request->getMethod() === 'post'){
            $data = array();
            $data = $_POST;
            $updated = $this->commonmodel->update_setting($data, 1);
            if($updated){
                $this->session->setFlashdata(['message'=>'Setting Update Successfully','type'=>'success']);
                return redirect()->to(base_url('/admin/setting'));
            }else{
                $this->session->setFlashdata(['message'=>'Something went wrong.','type'=>'danger']);
                return redirect()->to(base_url('/admin/setting'));
            }
        }
        else{
        $this->data['settings'] = $this->commonmodel->get_setting(1);
        
        return view("admin/setting/setting_edit",$this->data);
        }
        
    }
    /**************************************CMS************************************************ */
    public function cms()
	{
        $this->data['cms'] = $this->commonmodel->getAllRecord('tbl_cms');
        return view('admin/cms/cms_index', $this->data);
	}
    public function add_edit_cms($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'page'=>'required',
                'banner_title'=>'required',
                'banner_head'=>'required',
                'cms_banner'=>[
                    //'rules'=>'uploaded[image]|max_size[image,50]|ext_in[image,png,jpg,jpeg,bmp,gif]',
                    'rules'=>'max_size[cms_banner,524288000]|ext_in[cms_banner,png,jpg,jpeg,bmp,gif]',
                    'errors'=>[
                    //'uploaded'=>'Image is required.',
                    'max_size'=>'Image must not have size more than 500 MB in length.',
                    'ext_in'=>'File must have extension with png, gif, jpg, jpeg, bmp.',
                    ]
                ],
                //'description1'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
                //return view('admin/cms/add_edit_cms', $this->data);
            }else{
                //$id = $this->request->getPost('id');
                if($_FILES['cms_banner']['name'] != ''){
                    if($img = $this->request->getFile('cms_banner')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                            
                            $data['cms_banner'] = $newName;
                        }
                    }
                }
                $data['page'] = $_POST['page'];
                $data['banner_title'] = $_POST['banner_title'];
                $data['banner_head'] = $_POST['banner_head'];
                $data['description1'] = $_POST['description1'];
                //$data['description2'] = $_POST['description2'];
                //$data['description3'] = $_POST['description3'];
                //$data['description4'] = $_POST['description4'];
                //$data['description5'] = $_POST['description5'];
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_cms', $data);
                    if($inserted){
                        session()->setFlashdata(['message'=>'CMS added successfuly','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }else{
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_cms', $data, ['id'=>$id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'CMS Updated Successfully','type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong','type'=>'danger']);
                    }
                }
                
                return redirect()->to(site_url('admin/cms'));
            }
            
        }
        if($id){
            $this->data['cms'] = $this->commonmodel->getOneRecord('tbl_cms', ['id'=>$id]);
        }
        return view('admin/cms/add_edit_cms', $this->data);
    }
    public function delete_cms($id){
        if(!$id){
            return redirect()->to(site_url('admin/cms'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_cms',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'CMS Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'CMS Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/cms'));
        }
    }
    /******************************************Blogs*********************************** */
    public function blogs(){
        $this->data['blogs'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_blog','',['blg_id','desc']);
        return view('admin/blogs/index', $this->data);
	}
    public function add_edit_blog($id=''){
        date_default_timezone_set('Asia/Kolkata');
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'blog_title'=>'required',
                'blog_url'=>'required',
                'blog_details'=>'required',
                'meta_title'=>'required',
                'meta_description'=>'required',
                'meta_keyword'=>'required',
                'post_date'=>'required',
                'blog_added_by'=>'required',
                'blog_status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['blog_image']['name'] != ''){
                    if($img = $this->request->getFile('blog_image')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'b_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['blog_image'] = $newName;
                }
                $data['blog_title'] = $_POST['blog_title'];
                $data['blog_url'] = $_POST['blog_url'];
                $data['blog_details'] = $_POST['blog_details'];
                $data['meta_title'] = $_POST['meta_title'];
                $data['meta_description'] = $_POST['meta_description'];
                $data['meta_keyword'] = $_POST['meta_keyword'];
                $data['post_date'] = $_POST['post_date'];
                $data['blog_added_by'] = $_POST['blog_added_by'];
                $data['blog_status'] = $_POST['blog_status'];
                $data['added_at'] = date('Y-m-d H:i:s');
                if(!$id){
                    $inserted = $this->commonmodel->insertRecord('tbl_blog', $data);
                    if($inserted){
                        session()->setFlashdata(['message'=>'Blogs added successfuly', 'type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                    }
                }else{
                    $updated = $this->commonmodel->updateRecord('tbl_blog', $data, ['blg_id'=>$id]);
                    if($updated){
                        session()->setFlashdata(['message'=>'Blogs updated successfuly', 'type'=>'success']);
                    }else{
                        session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                    }
                }
                
                return redirect()->to(site_url('admin/blogs'));
            }
        }
        if($id){
            $this->data['blog'] = $this->commonmodel->getOneRecord('tbl_blog', ['blg_id'=>$id]);
        }
        return view('admin/blogs/add_edit_blog', $this->data);
    }
    public function delete_blog($id){
        if(!$id){
            return redirect()->to(site_url('admin/blogs'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_blog',['blg_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Blog Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Blog Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/blogs'));
        }
    }
    /******************************************Faq*********************************** */
    public function faq(){
        $this->data['faqs'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_faqs','',['faq_id','desc']);
        return view('admin/faq/index', $this->data);
	}
    public function add_edit_faq($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                //'faq_for'=>'required',
                'faq_title'=>'required',
                'faq_description'=>'required',
                //'faq_position'=>'required',
                'faq_status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                //$id = $this->request->getPost('faq_id');
                //if($_FILES['logo']['name'] != ''){
                //    if($img = $this->request->getFile('logo')){ 
                //        $imgname = $img->getName();
                //        if($img->isValid() && !$img->hasMoved()){
                //            $ext = explode('.',$imgname);
                //            $ext = end($ext);
                //            $newName = 't_'.time().'.'.$ext;
                //            $img->move('./public/assets/images/upload/testimonial/',$newName);
                //        }
                //    }
                //    $data['logo'] = $newName;
                //}else{
                //    if($id){
                //        $data['logo'] = $_POST['logo2'];
                //    }else{
                //        $data['logo'] = '';
                //    }
                //}
                //$data['faq_for'] = $_POST['faq_for'];
                $data['faq_title'] = $_POST['faq_title'];
                $data['faq_description'] = $_POST['faq_description'];
                //$data['faq_position'] = $_POST['faq_position'];
                $data['faq_status'] = $_POST['faq_status'];
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_faqs', $data);
                }else{
                    $data['modified_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_faqs', $data, ['faq_id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Faq added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Faq updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/faq'));
            }

        }
        if($id){
            $this->data['faq'] = $this->commonmodel->getOneRecord('tbl_faqs', ['faq_id'=>$id]);
        }
        return view('admin/faq/add_edit_faq', $this->data);
    }
    public function delete_faq($id){
        if(!$id){
            return redirect()->to(site_url('admin/faq'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_faqs',['faq_id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'faq Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Faq Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/faq'));
        }
    }
    /***************************************Testimonial****************************** */
    public function testimonial()
	{
        $this->data['testimonial'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_testimonial','',['id','desc']);
        return view('admin/testimonial/index', $this->data);
	}
    public function add_edit_testimonial($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'name'=>'required',
                'description'=>'required',
                'post'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                /*if($_FILES['logo']['name'] != ''){
                    if($img = $this->request->getFile('logo')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 't_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['logo'] = $newName;
                }*/
                if($_POST['logo'] != ''){
                    $data['logo'] = $_POST['logo'];
                }
                $data['name'] = $_POST['name'];
                $data['description'] = $_POST['description'];
                $data['post'] = $_POST['post'];
                $data['status'] = $_POST['status'];

                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_testimonial', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_testimonial', $data, ['id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Record added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Record updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/testimonial'));
                
            }

        }
        if($id){
            $this->data['testimonial'] = $this->commonmodel->getOneRecord('tbl_testimonial', ['id'=>$id]);
        }
        return view('admin/testimonial/add_edit_testimonial', $this->data);
    }
    public function delete_testimonial($id){
        if(!$id){
            return redirect()->to(site_url('admin/testimonial'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_testimonial',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/testimonial'));
        }
    }
    public function remove_testimonial_image($id){
        if(!$id){
            return redirect()->to(site_url('admin/testimonial'));
        }else{
            $deleted = $this->commonmodel->updateRecord('tbl_testimonial',['logo'=>''],['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Image Removed Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Image Not Removed. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/add_edit_testimonial/'.$id));
        }
    }
    /***********************************************Manage Banner************************************** */
    public function banner()
	{
        $this->data['banner'] = $this->commonmodel->get_banners();
        return view('admin/banner/index', $this->data);
	}
    public function add_edit_banner($id=false){
        if ($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'page'=>'required',
                //'url'=>'required',
                'main_title'=>'required',
                'sub_title'=>'required',
                'status'=>'required'
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['brochure']['name'] != ''){
                    if($img = $this->request->getFile('brochure')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && !$img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'ban_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/images/',$newName);
                        }
                    }
                    $data['brochure'] = $newName;
                }
                $data['page'] = $_POST['page'];
                //$data['url'] = $_POST['url'];
                $data['main_title'] = $_POST['main_title'];
                $data['sub_title'] = $_POST['sub_title'];
                $data['status'] = $_POST['status'];
                if(!$id){
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_banner', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_banner', $data, ['id'=>$id]);
                }
                    
                if(isset($inserted)){
                    session()->setFlashdata(['message'=>'Record added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>'Record updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                
                return redirect()->to(site_url('admin/banner'));
                
            }

        }
        if($id){
            $this->data['banner'] = $this->commonmodel->getOneRecord('tbl_banner', ['id'=>$id]);
        }
        $this->data['pages'] = $this->commonmodel->getAllRecord('tbl_page',['status'=>'1']);
        return view('admin/banner/add_edit_banner', $this->data);
    }
    public function delete_banner($id){
        if(!$id){
            return redirect()->to(site_url('admin/banner'));
        }else{
            $deleted = $this->commonmodel->deleteRecord('tbl_banner',['id'=>$id]);
            if($deleted){
                $this->session->setFlashdata(['message'=>'Record Deleted Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Delete. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/banner'));
        }
    }
    /*********************************************Contact us list************************************* */
    public function contact_us_list()
	{
        if ($this->request->getMethod() == 'post'){
            $id = $_POST['id'];
            $data['status'] = $_POST['status'];
            $updated = $this->commonmodel->updateRecord('tbl_contact_us', $data, ['id'=>$id]);
            if($updated){
                $this->session->setFlashdata(['message'=>'Record Updated Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Record Not Update. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(base_url('/admin/contact-us-list'));
        }
        $this->data['title'] = 'Contact us List';
        $this->data['listing'] = $this->adminmodel->get_contact_us_listing();
        return view('admin/contact_us/contact_us_index', $this->data);
	}
    /********************************************Product Management************************************ */
    public function products(){
        $this->data['page_title'] = 'Product List';
        $this->data['products'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_product','',['pro_id','DESC']);
        return view('admin/product/product_index', $this->data);
    }
    public function add_edit_product($id=false,$attr_id=false){
        
        $this->data['page_title'] = 'Product';
        if($this->request->getMethod() == 'post'){
            $id = (isset($_POST['pro_id']) && $_POST['pro_id'] != '')?$_POST['pro_id']:0;
            
            if($this->request->getPost('submit') == 'basic'){
                $tabname = 'Basic';
                $validation = $this->validate([
                    'product_name'=>[
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Please provide product name',
                        ]],
                    // 'timeshare_ids.*'=>['rules'=>'required','errors'=>['required'=>'Please select timeshare']],
                    'short_desc'=>[
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Please provide short description',
                        ]
                    ],
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    /*if($_FILES['image']['name'] != ''){
                        if($img = $this->request->getFile('image')){ 
                            $imgname = $img->getName();
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $newName = 'c_'.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$newName);
                            }
                        }
                        $data['image'] = $newName;
                    }
                    if($_FILES['youtube_vlink_image']['name'] != ''){
                        if($img = $this->request->getFile('youtube_vlink_image')){ 
                            $imgname = $img->getName();
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $newName = 'yimg_'.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$newName);
                            }
                        }
                        $data['youtube_vlink_image'] = $newName;
                    }*/
                    $data['product_name']       = $_POST['product_name'];
                    $data['url']                = $_POST['url'];
                    // $data['timeshare_ids'] = (!empty($_POST['timeshare_ids']))?implode(',', $_POST['timeshare_ids']):'';
                    $data['short_desc']         = $_POST['short_desc'];

                    if($_POST['home_image'] != ''){
                        $data['home_image'] = $_POST['home_image'];
                    }
                    $data['homeimage_alt']      = $_POST['homeimage_alt'];
                    $data['homeimage_title']    = $_POST['homeimage_title'];
                    $data['current_tab']        = 1;
                   
                }
            }
            if($this->request->getPost('submit') == 'Images'){
                //print_r($_POST);exit;
                $tabname = 'Images & Details';
                $validation = $this->validate([
                    // 'banner_image'=>[
                    //     'rules'=>'required',
                    //     'errors'=>[
                    //         'required' => 'Please provide banner image.',
                    //     ]
                    // ],
                    'detail_para'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please provide detail paragraph.',
                        ]
                    ],
                    'ingred_desc'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please provide Ingredients description.',
                        ]
                    ],
                    
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    if($_POST['detail_image'] != ''){
                        $data['detail_image'] = $_POST['detail_image'];
                    }
                    $data['detail_image_alt']   = $_POST['detail_image_alt'];
                    $data['detail_image_title'] = $_POST['detail_image_title'];
                    $data['detail_para']       = $_POST['detail_para'];
                    $data['ingred_desc']        = $_POST['ingred_desc'];
                    /*if($_POST['full_image'] != ''){
                        $data['full_image'] = $_POST['full_image'];
                    }
                    $data['full_image_alt'] = $_POST['full_image_alt'];
                    $data['full_image_title'] = $_POST['full_image_title'];
                    if($_POST['hotel_view_image'] != ''){
                        $data['hotel_view_image'] = $_POST['hotel_view_image'];
                    }
                    if($_POST['guest_room_image'] != ''){
                        $data['guest_room_image'] = $_POST['guest_room_image'];
                    }
                    if($_POST['fitness_image'] != ''){
                        $data['fitness_image'] = $_POST['fitness_image'];
                    }
                    if($_POST['dining_image'] != ''){
                        $data['dining_image'] = $_POST['dining_image'];
                    }
                    if($_POST['activities_image'] != ''){
                        $data['activities_image'] = $_POST['activities_image'];
                    }
                    if($_POST['spa_image'] != ''){
                        $data['spa_image'] = $_POST['spa_image'];
                    }
                    $data['des_beside_calender'] = $_POST['des_beside_calender'];*/
                    $data['current_tab'] = 2;
                }
            }
            if($this->request->getPost('submit') == 'room-features'){
                // print_r($_POST); exit;
                $tabname = 'Room Features';
                $validation = $this->validate([
                    'attr_value'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please provide Attribute value.',
                        ]
                    ],
                    'unit_id'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please select unit.',
                        ]
                    ],
                    'mrp'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please enter MRP.',
                        ]
                    ],
                    'sp'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please enter SP.',
                        ]
                    ],
                    'stock'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please enter stock.',
                        ]
                    ],
                    
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    $attributes = array();

                    $attributes['pro_id']       = $_POST['pro_id'];
                    $attributes['attr_value']   = $_POST['attr_value'];

                    $attributes['unit_id']      = $_POST['unit_id'];
                    $attributes['mrp']          = $_POST['mrp'];
                    $attributes['sp']           = $_POST['sp'];
                    $attributes['stock']        = $_POST['stock'];
                    $attributes['status']       = $_POST['status'];
                    
                    // echo '<pre>'; 
                    // print_r($featuresData);
                    
                    if(!empty($attributes)){
                        
                        if(!$attr_id){
                            $attributes['added_at'] = date('Y-m-d H:i:s');
                            $this->commonmodel->insertRecord('tbl_attributes', $attributes);
                            session()->setFlashdata(['message'=>'Attributes added successfully.', 'type'=>'success']);
                        }else{
                            $attributes['update_at'] = date('Y-m-d H:i:s');
                            $this->commonmodel->updateRecord('tbl_attributes', $attributes, ['attr_id'=>$attr_id]);
                            session()->setFlashdata(['message'=>'Attributes updated successfully.', 'type'=>'success']);
                        }
                        
                        // $data['current_tab'] = 3;
                    }else{
                        session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                    }
                    return redirect()->to(current_url());
                }
                //print_r($_POST); exit;
            }
            if($this->request->getPost('submit') == 'highlights'){
                $tabname = 'Resort Highlights';
                $validation = $this->validate([
                    'highlights_ids.*'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please select Resort Highlights',
                        ]
                    ],
                    
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    /*$headarr = $_POST['head'];
                    $dtlsarr = $_POST['dtls'];
                    $oflinedata = array();
                    for($i=0; $i < count($headarr); $i++){
                        if($headarr[$i] != '' && $dtlsarr[$i] != ''){
                            $oflinedata[$i]['head'] = $headarr[$i];
                            $oflinedata[$i]['dtls'] = $dtlsarr[$i];
                        }
                    }
                    $jsonoflinedata = json_encode($oflinedata);*/
                    if(!empty($_POST['highlights_ids'])){
                        // print_r($_POST['highlights_ids']); exit;
                        $data['highlights_ids'] = implode(',', $_POST['highlights_ids']);
                        $data['current_tab'] = 4;
                    }else{
                        session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                    }
                }
                //print_r($_POST); exit;
            }
            // About the Program
            if($this->request->getPost('submit') == 'amenities'){
                $tabname = 'Amenities';
                $validation = $this->validate([
                    'amenities_ids.*'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please select Amenities',
                        ]
                    ],
                    
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    /*$about_prg_Arr = array();
                    $k = 0;
                    for($n = 0; $n < 3; $n++){
                        $imgName = '';
                        if($_FILES['about_img']['name'][$n] != ''){
                            if($img = $this->request->getFile('about_img.'.$n)){ //main line 
                                $imgname = $img->getName();
                                
                                if($img->isValid() && !$img->hasMoved()){
                                    $ext = explode('.',$imgname);
                                    $ext = end($ext);
                                    $imgName = 'about_img_'.$n.time().'.'.$ext;
                                    $img->move('./public/assets/upload/images/',$imgName);
                                }
                            }
                        }else if($_POST['old_about_img'][$n] != ''){
                            $imgName = $_POST['old_about_img'][$n];
                        }

                        if($_POST['about_title'][$n] != '' && $_POST['about_desc'][$n] != ''){
                            $about_prg_Arr[$k]['about_title'] = $_POST['about_title'][$n];
                            $about_prg_Arr[$k]['about_desc'] = $_POST['about_desc'][$n];
                            $about_prg_Arr[$k]['about_img'] = $imgName;
                            $k++;
                        }

                    }*/
                    if(!empty($_POST['amenities_ids'])){
                        $data['amenities_ids'] = implode(',', $_POST['amenities_ids']);
                        $data['current_tab'] = 5;
                    }else{
                        session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                    }
                }
                
            }
            /*if($this->request->getPost('submit') == 'key-feature'){
                $tabname = 'key-features';
                if(count(array_filter($_POST['key_feature'])) > 0){
                    $data['key_features'] = json_encode(array_filter($_POST['key_feature']));
                    $data['complete_tab'] = 6;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }

            }
            
            if($this->request->getPost('submit') == 'course-breakdown'){
                //print_r($_POST);exit;
                $tabname = 'Course Breakdown';
                $validation = $this->validate([
                    'course_breakdown_desc' => 'required',
                    'prg_duration_line1'=> 'required',
                    'live_class'=> 'required',
                    'real_project'=> 'required',
                    'specializations'=> 'required',
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{ 
                    $data['course_breakdown_desc'] = $_POST['course_breakdown_desc'];
                    $data['prg_duration_line1'] = $_POST['prg_duration_line1'];
                    $data['live_class'] = $_POST['live_class'];
                    $data['real_project'] = $_POST['real_project'];
                    $data['specializations'] = $_POST['specializations'];
                    $data['complete_tab'] = 7;
                }

            }
            if($this->request->getPost('submit') == 'course-intro'){
                $tabname = 'course Intro';
                $count = count($_POST['module_name']);
                $course_intro_data = array();
                for($c = 0; $c < $count; $c++){
                    if($_POST['module_name'][$c] !='' && $_POST['module_duration'][$c] !='' && $_POST['module_syllabus'][$c] !=''){
                        $course_intro_data[$c]['module_name'] = $_POST['module_name'][$c];
                        $course_intro_data[$c]['module_duration'] = $_POST['module_duration'][$c];
                        $course_intro_data[$c]['module_syllabus'] = $_POST['module_syllabus'][$c];
                    }
                }
                //print_r($course_intro_data); exit;
                if(!empty($course_intro_data)){
                    $data['course_intro'] = json_encode($course_intro_data);
                    $data['complete_tab'] = 8;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }
            }
            if($this->request->getPost('submit') == 'faq'){
                $tabname = 'FAQ';
                $count = count($_POST['faq_title']);
                $faq_data = array();
                for($c = 0; $c < $count; $c++){
                    if($_POST['faq_title'][$c] !='' && $_POST['faq_desc'][$c] !='' ){
                        $faq_data[$c]['faq_title'] = $_POST['faq_title'][$c];
                        $faq_data[$c]['faq_desc'] = $_POST['faq_desc'][$c];
                    }
                }
                //print_r($course_intro_data); exit;
                if(!empty($faq_data)){
                    $data['faq'] = json_encode($faq_data);
                    $data['complete_tab'] = 9;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }
            }
            if($this->request->getPost('submit') == 'stu-stories'){
                $tabname = 'Student Stories';
                if(isset($course_dtls) && $course_dtls->stu_stories != ''){
                    $db_stu_stories = json_decode($course_dtls->stu_stories);
                }
                $stu_stories = array();
                $k = 0;
                $count = count($_POST['v_link']);
                for($n = 0; $n < $count; $n++){
                    $imgName = '';
                    if($_FILES['photo']['name'][$n] != ''){
                        if($img = $this->request->getFile('photo.'.$n)){ //main line 
                            $imgname = $img->getName();
                            
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $imgName = 'stusto_img_'.$n.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$imgName);
                            }
                        }
                    }
                    if($imgName == '' && isset($db_stu_stories) && isset($db_stu_stories[$n]->photo)){
                        $imgName = $db_stu_stories[$n]->photo;
                    }
                    //if($_POST['v_link'][$n] != '' && $imgName != ''){
                    if($imgName != ''){
                        $stu_stories[$k]['v_link'] = $_POST['v_link'][$n];
                        $stu_stories[$k]['photo'] = $imgName;
                        $k++;
                    }

                }
                if(!empty($stu_stories)){
                    $data['stu_stories_desc'] = $_POST['stu_stories_desc'];
                    $data['stu_stories'] = json_encode($stu_stories);
                    $data['complete_tab'] = 10;
                }else{
                    session()->setFlashdata(['message'=>'Please fill the data!.', 'type'=>'danger']);
                }
                
            }*/
            if($this->request->getPost('submit') == 'publish'){
                //print_r($_POST);exit;
                $tabname = 'Publish';
                /*$validation = $this->validate([
                    'map_address'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required' => 'Please provides map address',
                        ]
                    ],
                    
                ]);*/
                if($_POST['res_id'] == '' && $_POST['map_address'] == '' && $_POST['map_image'] == ''){
                    session()->setFlashdata(['message'=>'Please fill map address or upload map image.', 'type'=>'danger']);
                    return redirect()->to(site_url('admin/resort_cu'));
                }else{
                    $res_id = $_POST['res_id'];
                    if(!$res_id){
                        session()->setFlashdata(['message'=>'Please submit basic detail first.', 'type'=>'danger']);
                        return redirect()->to(site_url('admin/resort_cu'));
                    }
                    $data['map_address'] = $_POST['map_address'];
                    if($_POST['map_image'] != ''){
                        $data['map_image'] = $_POST['map_image'];
                    }
                    $data['is_popular'] = (isset($_POST['is_popular']))?1:0;
                    $data['current_tab'] = 6;
                    if($_POST['status'] == 1 && $res_id){
                        $resort = $this->commonmodel->getOneRecord('tbl_resorts', ['res_id'=>$res_id]);
                        if(!empty($resort)){
                            $error = 0;
                            $errorTxtArr = array();
                            if($resort->resort_name == ''){
                                $errorTxtArr[] = 'Resort Name';
                                $error = 1;
                            }
                            if($resort->timeshare_ids == ''){
                                $errorTxtArr[] = 'Timeshares';
                                $error = 1;
                            }
                            
                            if($resort->home_image == ''){
                                $errorTxtArr[] = 'Image for Home Page';
                                $error = 1;
                            }
                            if($resort->banner_image == ''){
                                $errorTxtArr[] = 'Image for Detail Page Banner';
                                $error = 1;
                            }
                            if($resort->detail_title == ''){
                                $errorTxtArr[] = 'Detail Title';
                                $error = 1;
                            }
                            if($resort->detail_desc == ''){
                                $errorTxtArr[] = 'Detail Description';
                                $error = 1;
                            }
                            if($resort->full_image == ''){
                                $errorTxtArr[] = 'Full Image for Detail Page';
                                $error = 1;
                            }
                            if($resort->hotel_view_image == ''){
                                $errorTxtArr[] = 'Hotel view image';
                                $error = 1;
                            }
                            if($resort->guest_room_image == ''){
                                $errorTxtArr[] = 'Guest Room Image';
                                $error = 1;
                            }
                            if($resort->fitness_image == ''){
                                $errorTxtArr[] = 'Fitness Image';
                                $error = 1;
                            }
                            if($resort->dining_image == ''){
                                $errorTxtArr[] = 'Dining Image';
                                $error = 1;
                            }
                            if($resort->activities_image == ''){
                                $errorTxtArr[] = 'Activities Image';
                                $error = 1;
                            }
                            if($resort->spa_image == ''){
                                $errorTxtArr[] = 'Spa Image';
                                $error = 1;
                            }
                            if($resort->des_beside_calender == ''){
                                $errorTxtArr[] = 'Description Beside Calender';
                                $error = 1;
                            }
                            $resort_rooms = $this->commonmodel->getAllRecordOrderByDesc('tbl_resorts_room',['res_id'=>$res_id], ['rm_id','DESC']);
                            if(empty($resort_rooms)){
                                $errorTxtArr[] = 'Room Features';
                                $error = 1;
                            }
                            if($resort->highlights_ids == ''){
                                $errorTxtArr[] = 'Resort Highlights';
                                $error = 1;
                            }
                            if($resort->amenities_ids == ''){
                                $errorTxtArr[] = 'Amenities';
                                $error = 1;
                            }
                            if($error){
                                $message = 'Please provides:  '.implode(', ', $errorTxtArr);
                                session()->setFlashdata(['message'=>$message, 'type'=>'danger']);
                                return redirect()->to(site_url('admin/resort_cu/'.$res_id));
                            }else{
                                $data['status'] = $_POST['status'];
                            }
                        }else{
                            session()->setFlashdata(['message'=>'Please submit basic detail first.', 'type'=>'danger']);
                            return redirect()->to(site_url('admin/resort_cu'));
                        }
                    }else{
                        $data['status'] = $_POST['status'];
                    }
                    
                }

            }
            /*if($this->request->getPost('submit') == 'seo'){
                $tabname = 'SEO';
                $validation = $this->validate([
                    'og_title'=>'required',
                    'meta_title'=>'required',
                    /*'description'=>[
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Course Overview is required',
                        ]
                    ],*
                ]);
                if(!$validation){
                    $this->data['validation'] = $this->validator;
                }else{
                    if($_FILES['og_image']['name'] != ''){
                        if($img = $this->request->getFile('og_image')){ 
                            $imgname = $img->getName();
                            if($img->isValid() && !$img->hasMoved()){
                                $ext = explode('.',$imgname);
                                $ext = end($ext);
                                $newName = 'ogimg_'.time().'.'.$ext;
                                $img->move('./public/assets/upload/images/',$newName);
                            }
                        }
                        $data['og_image'] = $newName;
                    }
                    
                    $data['og_type'] = $_POST['og_type'];
                    $data['og_url'] = $_POST['og_url'];
                    $data['og_title'] = $_POST['og_title'];
                    $data['og_site_name'] = $_POST['og_site_name'];
                    $data['og_description'] = $_POST['og_description'];
                    // $data['short_description'] = $_POST['short_description'];
                    $data['meta_title'] = $_POST['meta_title'];
                    $data['meta_keyword'] = $_POST['meta_keyword'];
                    $data['meta_description'] = $_POST['meta_description'];
                    // $data['youtube_vlink'] = $_POST['youtube_vlink'];
                    // $data['complete_tab'] = 1;
                   
                }
            }*/
            if(isset($data) && !empty($data)){
                if(!$id){
                    $data['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->insertRecord('tbl_product', $data);
                }else{
                    $data['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->updateRecord('tbl_product', $data, ['pro_id '=>$id]);
                }
                    
                if(isset($inserted)){
                    $id = $inserted;
                    session()->setFlashdata(['message'=>$tabname.' added successfuly', 'type'=>'success']);
                }else if(isset($updated)){
                    session()->setFlashdata(['message'=>$tabname.' updated successfuly', 'type'=>'success']);
                }else{
                    session()->setFlashdata(['message'=>'Something went wrong', 'type'=>'danger']);
                }
                if($id){
                    return redirect()->to(site_url('admin/product_cu/'.$id));
                }else{
                    return redirect()->to(site_url('admin/products'));
                }
            }
        }
        if($id){
            $this->data['products'] = $this->commonmodel->getOneRecord('tbl_product', ['pro_id'=>$id]);
            $this->data['attributes'] = $this->adminmodel->get_attributes_list();
        }
        if($attr_id){
            $this->data['attribute'] = $this->commonmodel->getOneRecord('tbl_attributes',['attr_id'=>$attr_id]);
        }
        $this->data['units'] = $this->commonmodel->getAllRecord('tbl_units',['status'=>1]);
        // $this->data['roomfeatures'] = $this->commonmodel->getAllRecord('tbl_room_features',['status'=>1]);
        // $this->data['highlights'] = $this->commonmodel->getAllRecord('tbl_resort_highlights',['status'=>1]);
        // $this->data['amenities'] = $this->commonmodel->getAllRecord('tbl_amenities',['status'=>1]);
        
        return view('admin/product/add_edit_product', $this->data);
    }
    public function update_current_tab(){
        if($this->request->getMethod() == 'post'){
            $tabno = $_POST['tabno'];
            $pro_id = $_POST['pro_id'];
            if($pro_id){
                $updated = $this->commonmodel->updateRecord('tbl_product', ['current_tab'=>$tabno], ['pro_id'=>$pro_id]);
                if($updated){
                    echo 'updated'; 
                }else{
                    echo 'not updated'; 
                }
            }else{
                echo 'false'; 
            }
            exit;
        }else{
            return redirect()->to(base_url('admin'));
        }
    }
    public function remove_image(){
        if($this->request->getMethod() == 'post'){
            $table = $_POST['table'];
            $field = $_POST['field'];
            $pkey = $_POST['pkey'];
            $id = $_POST['id'];
            $updated = $this->commonmodel->updateRecord($table, [$field=>''], [$pkey=>$id]);
            if($updated){
                $this->session->setFlashdata(['message'=>'Image Removed Successfully', 'type'=>'success']);
            }else{
                $this->session->setFlashdata(['message'=>'Something went wrong. Please try again...', 'type'=>'danger']);
            }
            exit;
        }else{
            return redirect()->to(base_url('admin'));
        }
    }
}
?>