<?php

namespace App\Controllers;
use App\Libraries\Paypal_lib;

class Home extends BaseController
{
    public $session;
    // public $paypal_lib;
    public $commonmodel;
    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
        // $this->paypal_lib = new Paypal_lib();
        $this->commonmodel = model('App\Models\Common_model', false);
    }
    public function index(): string
    {
        return view('index');
        // return view('home');
    }
    public function about_us(){
        $data['title'] = 'Super Roller | About-us';
        //$data['experts'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_experts',['status'=>1], ['exp_id','desc']);
        //$data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['page'=>4,'status'=>1]);
        return view('about_us', $data);
    }
    public function contact_us(){
        $data['title'] = 'Super Roller | Contact-us';
        //$data['timeshares'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_timeshare',['status'=>1], ['id','desc']);
        $data['countries'] = $this->commonmodel->getAllRecordOrderByDesc('tbl_countries',['status'=>1], ['countries_name','asc']);
        //$data['settings'] = $this->commonmodel->get_setting(1);
        //$data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['page'=>4,'status'=>1]);
        return view('contact_us', $data);
    }
    public function save_contact_us(){ 
		if($this->request->getMethod() == 'post'){
			$result = array();
			$validation = $this->validate([
				'name'=>[
					'rules'=>'required',
					'errors'=>['required'=>'Your Name is required']
				],
				'country'=>[
					'rules'=>'required',
					'errors'=>['required'=>'Country is required']
				],
				'email'=>[
					'rules'=>'required|valid_email',
					'errors'=>['required'=>'Email is required','valid_email'=>'Enter Valid Email']
				],
				'phone'=>[
					'rules'=>'required|is_natural|min_length[10]|max_length[10]',
					'errors'=>['required'=>'Phone Number is required','is_natural'=>'Enter Valid Phone Number','min_length'=>'Phone Number must be 10 digit in length','max_length'=>'Phone Number must not have more than 10 digit in length']
				],
                
			]);
			if(!$validation){
				$validator = $this->validator;
				$errors = array(
					'name' => $validator->getError('name'),
					'country' => $validator->getError('country'),
					'email' => $validator->getError('email'),
					'phone' => $validator->getError('phone'),
				);
				$result['error'] = $errors;
			}else{
				$data = array();
                
				$data['name'] 		= $this->request->getPost('name');
                $data['country'] 	= $this->request->getPost('country');
				$data['email'] 		= $this->request->getPost('email');
				$data['phone'] 		= $this->request->getPost('phone');
				$data['message'] 	= $this->request->getPost('message');
				$data['ipaddress'] 	= $this->request->getIPAddress();
                $data['status']     = 1;
				$data['added_at'] 	= date('y-m-d H:i:s');
				$insertId = $this->commonmodel->insertRecord('tbl_contact_us', $data);
				if($insertId){
                    $setting = $this->commonmodel->get_setting(1);
                    /*$msg = '<h2>Contact us</h2>
                        <p><strong>Full Name: </strong>'.$this->request->getPost('name').'</p>
                        <p><strong>Email: </strong>'.$this->request->getPost('email').'</p>
                        <p><strong>Phone: </strong>'.$this->request->getPost('phone').'</p>
                        <p><strong>Message: </strong>'.$this->request->getPost('message').'</p>';*/
                    $msg = '<p>Thank you for contacting us!. We will be in touch with you shortly.</p>
                            <p><strong>Regards</strong></p>
                            <p><strong>Career-Boss</strong></p>';
                    $email = \Config\Services::email();

                    $email->setFrom($setting->email, 'Bon-Voyage');
                    $email->setTo($this->request->getPost('email'));
                    //$email->setTo('test136@yopmail.com');
                    
                    $email->setSubject('Contact us');
                    $email->setMessage($msg);
                    
                    $email->send();
                    $swal_session = array(
                        'title'=>'Thank You!',
                        'text'=>'Thank you for contacting us!. We will be in touch with you shortly.',
                    );
                    session()->set('swal_session', $swal_session);
					$result['msg'] 	= 'success';
				}else{
					$result['err'] = 'fail';
				}
			}
			
			echo json_encode($result); exit;
		}
	}
    /*public function formsubmit(){
        if($this->request->getMethod() == 'post'){
            //echo '<pre>';print_r($_POST); exit;
            // write your own code here
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
                return view('form',['validation'=>$this->validator]);
            }else{
                echo '<pre>';print_r($_POST); exit;
            }
        }
        return view('form');
    }
    public function checkout(){
        $data['title'] = 'Checkout';
        $id = 11;
        $amount = 1;
        
        if($id){
            $returnURL = base_url('paypal-payment-success'); //payment success url
            $cancelURL = base_url('paypal-payment-cancel'); //payment cancel url
            $notifyURL = base_url('paypal-payment-notification'); //ipn url

            // Add fields to paypal form
            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', 'Mango');
            $this->paypal_lib->add_field('item_number', $id);
            $this->paypal_lib->add_field('amount', $amount);
            $this->paypal_lib->add_field('custom', $id);		
            $this->paypal_lib->add_field('quantity' ,1);
            $this->paypal_lib->add_field('lc' ,'US');
            $this->paypal_lib->add_field('upload' ,'1');
            $this->paypal_lib->add_field('cbt' ,'Return to The Store');
            
            // Render paypal form
            $this->paypal_lib->paypal_auto_form();
            exit;
        }else{
            session()->setFlashdata(['message'=>'Something went wrong. Please Try Again...','type'=>'danger']);
            return redirect()->to(base_url('/checkout'));
        }
        
    }
    public function paypal_payment_success(){
        if($this->request->getMethod() == 'post'){
            echo '<pre>';print_r($_POST); exit;
            // write your own code here
        }
        
    }
    public function paypal_payment_cancel(){
        echo 'Payment Cancel';
        // redirect your cancelation url
    }
    public function paypal_payment_notification(){
        echo 'payment notify';
        // redirect your cancelation url
    }*/
}
