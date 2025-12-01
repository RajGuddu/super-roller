<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
class NoAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        echo view('errors/html/error_404');
        exit;
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    // Do something here
    }
}