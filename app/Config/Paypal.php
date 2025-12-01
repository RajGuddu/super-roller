<?php 
namespace Config;

// ------------------------------------------------------------------------
// Paypal library configuration
// ------------------------------------------------------------------------
class Paypal extends \CodeIgniter\Config\BaseConfig
{
    // PayPal environment, Sandbox or Live
    public $sandbox = TRUE; // FALSE for live environment
    // public $sandbox = FALSE; // TRUE for demo environment

    // PayPal business demo email
    public $business = PAYAPAL_ID;

    // What is the default currency?
    public $paypal_lib_currency_code = 'USD';

    // Where is the button located at?
    public $paypal_lib_button_path = 'assets/images/';

    // If (and where) to log ipn response in a file
    public $paypal_lib_ipn_log = TRUE;
    public $paypal_lib_ipn_log_file = APPPATH . 'logs/paypal_ipn.log';
}