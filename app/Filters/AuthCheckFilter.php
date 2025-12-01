<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Admin\Auth_model;
class AuthCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $msg = '';        
        if(!session()->has('userlogin')){
            if(url_is('admin/*')){
                $msg = '<div class="alert alert-danger">You must be logged in!</div>';
            }
            return redirect()->to(ADMIN_LOGIN)->with('message', $msg);
        }

    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
    
}