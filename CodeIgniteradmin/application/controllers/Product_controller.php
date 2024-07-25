<?Php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();
    }

    public function product_create()
    {
        $this->load->view('product/product_create');
    }
}
