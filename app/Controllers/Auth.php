<?php

namespace App\Controllers;
use App\Models\Auth_model;
use App\Libraries\Hash;
class Auth extends BaseController
{
    public function __construct()
    {
        $this->data = array();
        $this->authmodel = model('App\Models\Auth_model', false);
    }
    public function login()
    {
        if ($this->request->getMethod() === 'post'){
            $validation = $this->validate([
                'email'=>[
                    'rules'=>'required|valid_email|is_not_unique[tbl_admin.email]',
                    'errors'=>[
                        'required'=>'Email is required',
                        'valid_email'=>'Enter a valid email address',
                        'is_not_unique'=>'This email is not registered on your service'
                    ]
                    ],
                'password'=>[
                    'rules'=>'required|min_length[5]|max_length[12]',
                    'errors'=>[
                        'required'=>'Password is required',
                        'min_length'=>'Password must have atleast 5 characters in length',
                        'max_length'=>'Password must not have more than 12 characters in length'
                    ]
                ]
            ]);
            if(!$validation){
                return view('auth/login',['validation'=>$this->validator]);
            }else{
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $user_info = $this->authmodel->isvalidate($email);
                if(empty($user_info)){
                    session()->setFlashdata('message','<div class="alert alert-danger">Inactive user. Contact administrator...</div>');
                    return redirect()->to('/'.ADMIN_LOGIN)->withInput(); 
                }
                $check_password = Hash::check($password, $user_info->password);
                if(!$check_password){
                    session()->setFlashdata('message','<div class="alert alert-danger">Incorrect Password</div>');
                    return redirect()->to('/'.ADMIN_LOGIN)->withInput();
                }else{
                    $sessionData = array(
                        'user_id' => $user_info->user_id,
                        'name' => $user_info->name,
                        'email' => $user_info->email,
                        'phone' => $user_info->phone,
                        'address' => $user_info->address,
                        'image' => $user_info->image,
                        'privilege_id' => $user_info->privilege_id,
                        'status' => $user_info->status,
                        'userlogin' => true,
                    );
                    //print_r($mysession);exit;
                    session()->set($sessionData);
                    //print_r(session()->get('IronManfs'));exit;
                    return redirect()->to('/admin');
                }
            }
        }
        return view('auth/login');
    }

    public function edit_profile(){
        if(!session()->has('userlogin')){
            return redirect()->to('/404');
        }
        $data = array();
        if ($this->request->getMethod() === 'post'){
            $validation = $this->validate([
                'name' => 'required',
                'email' => 'required',
            ]);
            if(!$validation){
                $this->data['validation'] = $this->validator;
            }else{
                if($_FILES['image']['name'] != ''){
                    if($img = $this->request->getFile('image')){ 
                        $imgname = $img->getName();
                        if($img->isValid() && ! $img->hasMoved()){
                            $ext = explode('.',$imgname);
                            $ext = end($ext);
                            $newName = 'dp_'.time().'.'.$ext;
                            $img->move('./public/assets/upload/users/',$newName);
                        }
                        $data['image'] = $newName;
                    }
                }
                $data['name'] = $this->request->getvar('name');
                $data['email'] = $this->request->getvar('email');
                $data['phone'] = $this->request->getvar('phone');
                $data['address'] = $this->request->getvar('address');
                $data['updated'] = date('Y-m-d H:i:s');

                $updated = $this->authmodel->update_profile($data, session('user_id'));
                if($updated){
                    $user_info =  $this->authmodel->get_profile_data();
                    $sess_item = ['user_id','name','email','phone','address','image','privilege_id','status','userlogin'];
                    session()->remove($sess_item);
                    $sessionData = array(
                        'user_id' => $user_info->user_id,
                        'name' => $user_info->name,
                        'email' => $user_info->email,
                        'phone' => $user_info->phone,
                        'address' => $user_info->address,
                        'image' => $user_info->image,
                        'privilege_id' => $user_info->privilege_id,
                        'status' => $user_info->status,
                        'userlogin' => true,
                    );
                    //print_r($mysession);exit;
                    session()->set($sessionData);

                    $this->session->setFlashdata('message', '<div class="alert alert-success">User Update Successfully</div>');
                }else{
                    $this->session->setFlashdata('message', '<div class="alert alert-danger">Please Try After Sometimes...</div>');
                }
                return redirect()->to(base_url('/profile'));
            }
        }
        $this->data['profile'] = $this->authmodel->get_profile_data();
        //print_r($this->data['profile']); exit;
        return view('auth/edit_profile', $this->data);
        
    }
    public function change_password(){
        if($this->request->getMethod() == 'post'){
            $validation = $this->validate([
                'oldpwd' => [
                    'rules'=>'required|min_length[5]|max_length[12]',
                    'errors'=>[
                        'required'=>'Old Password is required',
                        'min_length'=>'Old Password must have atleast 5 character in length',
                        'max_length'=>'Old Password must not have characters more than 12 in length'
                    ]
                ],
                'pwd' => [
                    'rules'=>'required|min_length[5]|max_length[12]',
                    'errors'=>[
                        'required'=>'Password is required',
                        'min_length'=>'Password must have atleast 5 character in length',
                        'max_length'=>'Password must not have characters more than 12 in length'
                    ]
                ],
                'cpwd' => [
                    'rules'=>'required|min_length[5]|max_length[12]|matches[pwd]',
                    'errors'=>[
                        'required'=>'Confirm password is required',
                        'min_length'=>'Confirm Password must have atleast 5 character in length',
                        'max_length'=>'Confirm Password must not have characters more than 12 in length',
                        'matches'=>'Confirm Password not matches to password'
                    ]
                ]
            ]);
            if(!$validation){
                // return view('auth/change_password', $this->data);
                $this->data['validation'] = $this->validator;
                $this->data['profile'] = $this->authmodel->get_profile_data();
                //print_r($this->data['profile']); exit;
                return view('auth/edit_profile', $this->data);
            }else{
                $email = session('email');
                $oldPassword = $this->request->getPost('oldpwd');
                $user_info = $this->authmodel->isvalidate($email);
                
                $check_password = Hash::check($oldPassword, $user_info->password);
                if(!$check_password){
                    session()->setFlashdata('message','<div class="alert alert-danger">Incorrect Password</div>');
                    return redirect()->to('profile')->withInput();
                }else{

                    $data = array();
                    $password = $this->request->getvar('pwd');
                    $data['password'] = Hash::make($password);
                    $updated = $this->authmodel->update_profile($data, session('user_id'));
                    if($updated){
                        session()->setFlashdata('message', '<div class="alert alert-success">Password changed successfully.</div>');
                    }else{
                        session()->setFlashdata('message', '<div class="alert alert-danger">Something went wrong.</div>');
                    }
                    return redirect()->to('profile');
                }
            }
        }else{
            $this->data['profile'] = $this->authmodel->get_profile_data();
            return view('auth/edit_profile', $this->data);
        }
    }
    public function logout(){
        if(session()->has('userlogin')){
            $loginItemArray = ['user_id','name','email','phone','address','image','privilege_id','status','userlogin'];
            session()->remove($loginItemArray);
            //session()->destroy();
            return redirect()->to('/'.ADMIN_LOGIN.'?access=out')->with('message','<div class="alert alert-success">You are logged out</div>');
        }
        return redirect()->back();
    }
    public function forgot_password(){
        if ($this->request->getMethod() === 'post' && $this->request->getPost('forgot_pass') == '1'){
            $validation = $this->validate([
                'email'=>[
                    'rules'=>'required|valid_email|is_not_unique[tbl_admin.email]',
                    'errors'=>[
                        'required'=>'Email is required',
                        'valid_email'=>'Enter a valid email address',
                        'is_not_unique'=>'This email is not registered on your service'
                    ]
                ]
            ]);
            if(!$validation){
                return view('auth/login',['validation'=>$this->validator]);
            }else{
                $useremail = $this->request->getPost('email');
                $user_info = $this->authmodel->isvalidate($useremail);
                $newpassword = mt_rand(100000, 999999);
                $haspassword = Hash::make($newpassword);
                $data['password'] = $haspassword;
                $updated = $this->authmodel->update_profile($data, $user_info->id);
                if($updated){
                    $msg = '<p>Dear <b>'.$user_info->name.'</b></p>
                            <p>Your new temporary Password is: <b>'.$newpassword.'</b></p>
                            <p>Login and change you with your choice Password.</p>
                            <p>Thank You</p>';
                    $email = \Config\Services::email();
                    $email->setFrom('test@wps-dev.com', 'wps-dev.com');
                    $email->setTo($user_info->email);
                    $email->setSubject('Forgot Password');
                    $email->setMessage($msg);
                    $email->send();
                    session()->setFlashdata('message','<div class="alert alert-success">A mail has been sent with new password to your respected email.</div>');
                    return redirect()->to('/login')->withInput();
                }else{
                    session()->setFlashdata('message','<div class="alert alert-danger">Something went wrong!</div>');
                    return redirect()->to('/login')->withInput();
                }
                
            }
        }
    }
}
