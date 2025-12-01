<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
class AlreadyLoggedInFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if(session()->has('userlogin')){
            // return redirect()->back();
            return redirect()->to(base_url('/admin'));
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    // Do something here
    }
}