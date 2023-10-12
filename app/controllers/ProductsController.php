<?php
//ProductsController Controller 
class ProductsController extends Controller{
    private $data = [], $model = null;

    public function __construct(){
        $this->model = $this->model('ProductsModel');
    }

    public function index(){
        $dataProLaptop = $this->db->table('tbl_product')->join('tbl_category', 'tbl_product.idCategory = tbl_category.idCategory')->where('catName', '=', 'Laptop')->get();
        $dataProPhone = $this->db->table('tbl_product')->join('tbl_category', 'tbl_product.idCategory = tbl_category.idCategory')->where('catName', '=', 'Smartphone')->get();
        $dataProDesktop = $this->db->table('tbl_product')->join('tbl_category', 'tbl_product.idCategory = tbl_category.idCategory')->where('catName', '=', 'Desktop')->get();
        $dataProHouseware = $this->db->table('tbl_product')->join('tbl_category', 'tbl_product.idCategory = tbl_category.idCategory')->where('catName', '=', 'Houseware')->get();
        $dataProTV = $this->db->table('tbl_product')->join('tbl_category', 'tbl_product.idCategory = tbl_category.idCategory')->where('catName', '=', 'TV')->get();
        if(!empty(Session::data('customer'))){
            $customerInfo = Session::data('customer');
            $this->data['header']['customer'] = $customerInfo;
        }
        $this->data['body'] = 'products/products';
        $this->data['header']['title'] = 'Sản phẩm';
        $this->data['header']['totalPrice'] = Session::data('totalPrice');
        $this->data['sub_data']['laptops'] = $dataProLaptop;
        $this->data['sub_data']['phones'] = $dataProPhone;
        $this->data['sub_data']['desktops'] = $dataProDesktop;
        $this->data['sub_data']['housewares'] = $dataProHouseware;
        $this->data['sub_data']['tvs'] = $dataProTV;
        $this->view('layouts/clients.layout', $this->data);
    }

    public function detailProduct($id){
        $dataProduct = $this->model->getProduct($id);
        $dataCates = $this->db->table('tbl_category')->get();
        $dataBrands = $this->db->table('tbl_brand')->get();
        if(!empty(Session::data('customer'))){
            $customerInfo = Session::data('customer');
            $this->data['header']['customer'] = $customerInfo;
        }
        $this->data['body'] = 'products/detail';
        $this->data['header']['title'] = 'Chi tiết sản phẩm';
        $this->data['header']['totalPrice'] = Session::data('totalPrice');
        $this->data['sub_data']['data'] = $dataProduct;
        $this->data['sub_data']['dataCates'] = $dataCates;
        $this->data['sub_data']['dataBrands'] = $dataBrands;
        $this->data['sub_data']['error_order'] = Session::flashData('error_cart');
        $this->view('layouts/clients.layout', $this->data);
    }

    public function searchProduct(){
        $request = new Request();
        $response = new Response();

        if($request->isPost()){
            $rulesArr = [
                'nameSearch' => 'required',
            ];

            $messagesArr = [
                'nameSearch.required' => 'Không được để trống!',
            ];

            $request->rules($rulesArr);
            $request->message($messagesArr);
            $statusValidate = $request->validate();

            if($statusValidate){
                $dataPost = $request->getFields();
                $data = $this->model->searchProduct($dataPost['nameSearch']);
                Session::flashData('data_product', $data);
            } else {
                Session::flashData('errors_search', $request->getErrors());
            }
            Session::flashData('old_search', $request->getFields());

            $response->redirect(_WEB_ROOT . '/products/showProduct');
        }
    }

    public function showProduct(){
        $this->data['body'] = 'products/showProducts';
        $this->data['header']['title'] = 'Tìm kiếm';
        $this->data['header']['errors'] = Session::flashData('errors_search');
        $this->data['header']['old'] = Session::flashData('old_search');
        $this->data['sub_data']['data'] = Session::flashData('data_product');
        $this->view('layouts/clients.layout', $this->data);
    }
}