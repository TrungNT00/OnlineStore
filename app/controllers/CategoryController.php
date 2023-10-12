<?php
//CategoryController Controller 
class CategoryController extends Controller{
    private $data = [], $model = null;

    public function __construct(){
        $this->model = $this->model('CategoriesModel');
    }

    public function index(){
        $dataCategories = $this->model->getAllCategories();
        $dataProducts = $this->db->table('tbl_product')->get();
        if(!empty(Session::data('customer'))){
            $customerInfo = Session::data('customer');
            $this->data['header']['customer'] = $customerInfo;
        }
        $this->data['body'] = 'categories/listCategory';
        $this->data['header']['totalPrice'] = Session::data('totalPrice');
        $this->data['header']['title'] = 'Danh Mục';
        $this->data['sub_data']['dataCates'] = $dataCategories;
        $this->data['sub_data']['dataProducts'] = $dataProducts;
        $this->view('layouts/clients.layout', $this->data);
    }

    public function get(){

    }

    public function getCategory($id){
        $dataProduct = $this->db->table('tbl_product')->join('tbl_category', 'tbl_product.idCategory = tbl_category.idCategory')->where('tbl_category.idCategory', '=', $id)->get();
        $categoryName = $this->model->getCategory($id);
        $this->data['body'] = 'categories/categories';
        $this->data['sub_data']['data'] = $dataProduct;
        $this->data['sub_data']['catName'] = $categoryName;
        $this->view('layouts/clients.layout', $this->data);
    }
}