<?php
//Admin/BrandsController Controller 
class BrandsController extends Controller{
    private $data = [], $model = null;

    public function __construct(){
        $this->model = $this->model('BrandModel');
    }
    
    public function showBrand(){
        $response = new Response();
        $dataBrands = $this->model->getAllBrands();
        if(!empty(Session::data('admin_login'))){
            $this->data['body'] = 'admin/listBrand';
            $this->data['sub_data']['data'] = $dataBrands;
            $this->data['sub_data']['success'] = Session::flashData('success_update');
            $this->data['sub_data']['success'] = Session::flashData('success_delete');
            $this->data['sub_data']['warning'] = Session::flashData('warning_update');
            $this->data['sub_data']['warning'] = Session::flashData('warning_delete');
            $this->view('layouts/admin.layout', $this->data);
        } else {
            $response->redirect(_WEB_ROOT. '/admin');
        }
    }
    
    public function addBrand(){
        $response = new Response();
        if(!empty(Session::data('admin_login'))){
            $this->data['body'] = 'admin/addBrand';
            $this->data['sub_data']['errors'] =  Session::flashData('error_brand');
            $this->data['sub_data']['success'] =  Session::flashData('success_brand');
            $this->data['sub_data']['warning'] =  Session::flashData('warning_brand');
            $this->view('layouts/admin.layout', $this->data);
        } else {
            $response->redirect(_WEB_ROOT. '/admin');
        }
    }

    public function handleAddBrand(){
        $request = new Request();
        $response = new Response();

        if($request->isPost()){
            $rulesArr = [
                'brandName' => 'required|min:2|uniqueExisted:tbl_brand:brandName'
            ];

            $messageArr = [
                'brandName.required' => '* Tên thương hiệu không được để trống',
                'brandName.min' => '* Tối thiểu 2 kí tự',
                'brandName.uniqueExisted' => '* Tên thương hiệu đã tồn tại'
            ];

            $request->rules($rulesArr);
            $request->message($messageArr);
            $statusValidate = $request->validate();
            if($statusValidate){
                $dataPost = $request->getFields();
                $dataInsert = [
                    'brandName' => $dataPost['brandName']
                ];
                $statusInsert = $this->model->insertBrand($dataInsert);
                if($statusInsert){
                    Session::flashData('success_brand', 'Thêm thương hiệu thành công.');
                } else {
                    Session::flashData('warning_brand', 'Thêm thất bại. Vui lòng thử lại sau!');
                }
            } else {
                Session::flashData('error_brand', $request->getErrors());
            }

            $response->redirect(_WEB_ROOT . '/admin/brands/addBrand');
        }
    }

    public function editBrand($id){
        $dataBrand = $this->model->getBrand($id);
        $this->data['body'] = 'admin/editBrand';
        $this->data['sub_data']['data'] = $dataBrand;
        $this->data['sub_data']['error_update'] = Session::flashData('error_update');
        $this->view('layouts/admin.layout', $this->data);
    }

    public function handleEditBrand($id){
        $request = new Request();
        $response = new Response();

        if($request->isPost()){
            $rulesArr = [
                'brandName' => 'required|min:2|uniqueExisted:tbl_brand:brandName'
            ];

            $messageArr = [
                'brandName.required' => '* Tên thương hiệu không được để trống',
                'brandName.min' => '* Tối thiểu 2 kí tự',
                'brandName.uniqueExisted' => '* Tên thương hiệu đã tồn tại',
            ];

            $request->rules($rulesArr);
            $request->message($messageArr);
            $statusValidate = $request->validate();
            
            if($statusValidate){
                $dataPost = $request->getFields();
                $dataUpdate = [
                    'brandName' => $dataPost['brandName']
                ];

                $statusUpdate = $this->model->updateBrand($id, $dataUpdate);
                if($statusUpdate){
                    Session::flashData('success_update', 'Cập nhật thương hiệu thành công');
                }else {
                    Session::flashData('warning_update', 'Cập nhật thất bại. Vui lòng thử lại sau!');
                }
                $response->redirect(_WEB_ROOT . '/admin/brands/showBrand');
                die();
            } else{
                Session::flashData('error_update', $request->getErrors());
                $response->redirect(_WEB_ROOT . '/admin/brands/editBrand/'. $id);
            }
        }
    }

    public function deleteBrand($id){
        $response = new Response();
        $statusDelete = $this->model->deleteBrand($id);
        if($statusDelete){
            Session::flashData('success_delete', 'Xóa thành công');
        } else {
            Session::flashData('warning_delete', 'Xóa thất bại. Vui lòng thử lại sau!');
        }

        $response->redirect(_WEB_ROOT . '/admin/brands/showBrand');
    }
}