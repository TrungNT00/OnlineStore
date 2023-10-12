<?php
//ContactController Controller 
class ContactController extends Controller{
    private $data = [], $model = [];

    public function __construct(){
        //construct
    }

    public function index(){
        if(!empty(Session::data('customer'))){
            $customerInfo = Session::data('customer');
            $this->data['header']['customer'] = $customerInfo;
        }
        $this->data['body'] = 'clients/contact';
        $this->data['header']['title'] = 'Liên hệ';
        $this->data['header']['totalPrice'] = Session::data('totalPrice');
        $this->view('layouts/clients.layout', $this->data);
    }
}