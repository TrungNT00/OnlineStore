<?php
//Admin/CategoriesController Controller 
class CategoriesController extends Controller{
    private $data = [], $model = null;

    public function __construct(){
        $this->model = $this->model('CategoriesModel');
    }

    public function index(){
       $this->showCategories();
    }

    public function showCategories(){
        $response = new Response();
        $dataCate = $this->model->getAllCategories();
        
        if(!empty(Session::data('admin_login'))){
            $this->data['body'] = 'admin/listCategories';
            $this->data['sub_data']['categories'] = $dataCate;
            $this->data['sub_data']['successUpdate'] = Session::flashData('success');
            $this->data['sub_data']['warning_cate'] = Session::flashData('warning_cate');
            $this->view('layouts/admin.layout',$this->data);
        } else {
            $response->redirect(_WEB_ROOT . '/admin');
        }
    }
    
    public function addCategory(){
        $response = new Response();

        if(!empty(Session::data('admin_login'))){
            $this->data['body'] = 'admin/addCategories';
            $this->data['sub_data']['error_cate'] = Session::flashData('error_cate');
            $this->data['sub_data']['oldData_cate'] = Session::flashData('oldData_cate');
            $this->data['sub_data']['success_cate'] = Session::flashData('success_cate');
            $this->data['sub_data']['warning_cate'] = Session::flashData('warning_cate');
            $this->view('layouts/admin.layout', $this->data);
        } else {
            $response->redirect(_WEB_ROOT . '/admin');
        }
    }

    public function handleAddCategory(){
        $request = new Request();
        $response = new Response();

        if($request->isPost()){
            $rulesArr = [
                'catName' => 'required|min:2|uniqueExisted:tbl_category:catName',
            ];

            $messagesArr = [
                'catName.required' => '* Tên danh mục không được để trống',
                'catName.min' => '* Tối thiểu 2 ký tự',
                'catName.uniqueExisted' => '* Tên danh mục đã tồn tại'
            ];

            $request->rules($rulesArr);
            $request->message($messagesArr);
            $statusValidate = $request->validate();

            if($statusValidate){
                $dataInsert = [
                    'catName' => trim($request->getFields()['catName'])
                ];

                $statusInsert = $this->model->addCategories($dataInsert);
                if($statusInsert){
                    Session::flashData('success_cate', 'Thêm danh mục thành công');
                } else {
                    Session::flashData('warning_cate', 'Hệ thông đang lỗi. Vui lòng thử lại sau');
                }
            } else {
                Session::flashData('error_cate', $request->getErrors());
                Session::flashData('oldData_cate', $request->getFields());
            }

            $response->redirect(_WEB_ROOT . '/admin/categories/addCategory');
        }
    }

    public function editCategory($id){
        $dataCate = $this->model->getCategory($id);
        $this->data['body'] = 'admin/editCategories';
        $this->data['sub_data']['category'] = $dataCate;
        $this->data['sub_data']['error'] = Session::flashData('error_update');
        $this->view('layouts/admin.layout', $this->data);
    }

    public function handleEditCategory($id){
        $request = new Request();
        $response = new Response();

        if($request->isPost()){
            $rulesArr = [
                'catName' => 'required|min:2|uniqueExisted:tbl_category:catName',
            ];

            $messagesArr = [
                'catName.required' => '* Tên danh mục không được để trống',
                'catName.min' => '* Tối thiểu 2 ký tự',
                'catName.uniqueExisted' => '* Tên danh mục đã tồn tại'
            ];

            $request->rules($rulesArr);
            $request->message($messagesArr);
            $statusValidate = $request->validate();

            if($statusValidate){
                $dataUpdate = [
                    'catName' => trim($request->getFields()['catName'])
                ];

                $statusUpdate = $this->model->updateCategory($id, $dataUpdate);
                if($statusUpdate){
                    Session::flashData('success', 'Update danh mục thành công');
                } else {
                    Session::flashData('warning_cate', 'Hệ thông đang lỗi. Vui lòng thử lại sau');
                }
                $response->redirect(_WEB_ROOT . '/admin/categories');
                die();
            } else {
                Session::flashData('error_update', $request->getErrors());
                $response->redirect(_WEB_ROOT . '/admin/categories/editCategory/'.$id);
            }
        }
    }

    public function deleteCategory($id){
        $response = new Response();

        $statusDelete = $this->model->deleteCategory($id);
        if($statusDelete){
            Session::flashData('success', 'Xóa thành công');
        } else {
            Session::flashData('warning_cate', 'Hệ thống đang bị lôi. Vui lòng thử lại sau!');
        }
        $response->redirect(_WEB_ROOT . '/admin/categories');
    }
}