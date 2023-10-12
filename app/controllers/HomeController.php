<?php
//HomeController Controller 
class HomeController extends Controller{
    private $data = [], $model = null, $modelPro = null, $modelCate = null, $modelBrand = null;

    public function __construct(){
        $this->modelPro = $this->model('ProductsModel');
        $this->modelCate = $this->model('CategoriesModel');
        $this->modelBrand = $this->model('BrandModel');
    }

    public function index(){
        $dataProducts = $this->db->table('tbl_product')->limit(1,4)->get();
        $dataProLaptop = $this->modelPro->getProductByCate('Laptop');
        $dataProTV = $this->modelPro->getProductByCate('TV');
        $dataProPhone = $this->modelPro->getProductByCate('Smartphone');
        $dataProHouseWare = $this->modelPro->getProductByCate('Houseware');
        if(!empty(Session::data('customer'))){
            $customerInfo = Session::data('customer');
            $this->data['header']['customer'] = $customerInfo;
        }
        $this->data['header']['title'] = 'Online Store';
        $this->data['header']['totalPrice'] = Session::data('totalPrice');
        $this->data['dataProducts'] = $dataProducts;
        $this->data['sub_data']['dataProLaptop'] = $dataProLaptop;
        $this->data['sub_data']['dataProTV'] = $dataProTV;
        $this->data['sub_data']['dataProPhone'] = $dataProPhone;
        $this->data['sub_data']['dataProHouseWare'] = $dataProHouseWare;
        $this->view('home', $this->data);
    }

    public function editProfile($id){
        $this->data['body'] = 'clients/editProfile';
        $this->view('layouts/clients.layout', $this->data);
    }
}