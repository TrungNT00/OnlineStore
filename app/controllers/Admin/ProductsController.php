<?php
//Admin/ProductsController Controller 
class ProductsController extends Controller{
    private $data = [], $model = null, $modelCate = null, $modelBrand = null;

    public function __construct(){
        $this->modelCate = $this->model('CategoriesModel');
        $this->modelBrand = $this->model('BrandModel');
        $this->model = $this->model('ProductsModel');
    }

    public function index(){
        // index
    }

    public function showProducts(){
        $response = new Response();
        $dataProducts = $this->model->getAllProducts();
        $dataCate = $this->modelCate->getAllCategories();
        $dataBrand = $this->modelBrand->getAllBrands();
        
        if(!empty(Session::data('admin_login'))){
            $this->data['body'] = 'admin/listProducts';
            $this->data['sub_data']['dataPro'] = $dataProducts;
            $this->data['sub_data']['dataCate'] = $dataCate;
            $this->data['sub_data']['dataBrands'] = $dataBrand;
            $this->data['sub_data']['success'] = Session::flashData('success_product');
            $this->view('layouts/admin.layout', $this->data);
        } else {
            $response->redirect(_WEB_ROOT .'/admin');
        }
    }

    public function addProduct(){
        $response = new Response();
        $dataCate = $this->modelCate->getAllCategories();
        $dataBrand = $this->modelBrand->getAllBrands();
        if(!empty(Session::data('admin_login'))){
            $this->data['body'] = 'admin/addProducts';
            $this->data['sub_data']['dataCate'] = $dataCate;
            $this->data['sub_data']['dataBrand'] = $dataBrand;
            $this->data['sub_data']['success'] = Session::flashData('success_pro');
            $this->data['sub_data']['warning'] = Session::flashData('warning_pro');
            $this->data['sub_data']['errors'] = Session::flashData('error_pro');
            $this->data['sub_data']['oldData'] = Session::flashData('oldData_pro');
            $this->view('layouts/admin.layout', $this->data);
        } else {
            $response->redirect(_WEB_ROOT .'/admin');
        }
    }

    public function handleAddProduct(){
        $request = new Request();
        $response = new Response();

        if($request->isPost()){
            $rulesArr = [
                'proName' => 'required|min:3|unqueExisted:tbl_product:proName',
                'idCate' => 'required',
                'idBrand' => 'required',
                'description' => 'required',
                'proPrice' => 'required|min:4|max:12',
                'type' => 'required',
                'upload' => 'file:required|file:extend|file:size|file:error',
            ];

            $messageArr = [
                'proName.required' => '* Tên sản phẩm không được để trống',
                'proName.min' => '* Tối thiểu 3 kí tự',
                'proName.uniqueExisted' => '* Tên sản phẩm đã tồn tại',
                'idCate.required' => '* Tên danh mục không được để trống',
                'idBrand.required' => '* Tên thương hiệu không được để trống',
                'description.required' => '* Mô tả sản phẩm không được để trống',
                'proPrice.required' => '* Giá sản phẩm không được để trống',
                'proPrice.min' => '* Giá sản phẩm tối thiểu 1000 Vnd',
                'proPrice.max' => '* Giá sản phẩm quá lớn',
                'type.required' => '* Loại sản phẩm không được để trống',
                'upload.required' => '* Hình ảnh sản phẩm không được trống',
                'upload.extend' => '* File không đúng định dạng cho phép',
                'upload.min' => '* Kích thước quá lớn',
                'upload.error' => '* File bị lỗi. Vui lòng thử lại sau'
            ];

            $request->rules($rulesArr);
            $request->message($messageArr);
            $statusValidate = $request->validate();

            if($statusValidate){
                $dataPost = $request->getFields();
                $image = uniqid(time()). '-' . $dataPost['upload']['name'];
                $dataInsert = [
                    'proName' => $dataPost['proName'],
                    'idCategory' => $dataPost['idCate'],
                    'idBrand' => $dataPost['idBrand'],
                    'proPrice' => $dataPost['proPrice'],
                    'image' => $image,
                    'description' => $dataPost['description'],
                    'type' => $dataPost['type'],
                ];

                $statusInsert = $this->model->insertProduct($dataInsert);

                if($statusInsert){
                    $file_tmp = $dataPost['upload']['tmp_name'];
                    $statusUpload = move_uploaded_file($file_tmp, _DIR_ROOT . '/public/uploads/'. $image);
                    if($statusUpload){
                        Session::flashData('success_pro', 'Thêm sản phẩm mới thành công.');
                    } else {
                        Session::flashData('warning_pro', 'Thêm sản phẩm bị lỗi. Vui lòng thử lại sau!');
                    }
                } else {
                    Session::flashData('warning_pro', 'Thêm sản phẩm bị lỗi. Vui lòng thử lại sau!');
                }

            } else {
                Session::flashData('error_pro', $request->getErrors());
                Session::flashData('oldData_pro', $request->getFields());
            }

            $response->redirect(_WEB_ROOT . '/admin/products/addProduct');
        }
    }

    public function editProduct($id){
        $data = $this->model->getProduct($id);
        $dataCate = $this->modelCate->getAllCategories();
        $dataBrand = $this->modelBrand->getAllBrands();
        $this->data['body'] = 'admin/editProduct';
        $this->data['sub_data']['dataPro'] = $data;
        $this->data['sub_data']['dataCate'] = $dataCate;
        $this->data['sub_data']['dataBrand'] = $dataBrand;
        $this->data['sub_data']['oldData'] = Session::flashData('oldData_product');
        $this->data['sub_data']['warning'] = Session::flashData('warning_product');
        $this->data['sub_data']['errors'] = Session::flashData('errors_product');
        $this->view('layouts/admin.layout', $this->data);
    }

    public function handleEditProduct($id){
        $request = new Request();
        $response = new Response();
        if($request->isPost()){
            $rulesArr = [
                'proName' => 'required|min:3|unqueExisted:tbl_product:proName',
                'idCategory' => 'required',
                'idBrand' => 'required',
                'description' => 'required',
                'proPrice' => 'required|min:4|max:12',
                'type' => 'required',
            ];

            $messageArr = [
                'proName.required' => '* Tên sản phẩm không được để trống',
                'proName.min' => '* Tối thiểu 3 kí tự',
                'proName.uniqueExisted' => '* Tên sản phẩm đã tồn tại',
                'idCategory.required' => '* Tên danh mục không được để trống',
                'idBrand.required' => '* Tên thương hiệu không được để trống',
                'description.required' => '* Mô tả sản phẩm không được để trống',
                'proPrice.required' => '* Giá sản phẩm không được để trống',
                'proPrice.min' => '* Giá sản phẩm tối thiểu 1000 Vnd',
                'proPrice.max' => '* Giá sản phẩm quá lớn',
                'type.required' => '* Loại sản phẩm không được để trống',
            ];

            $request->rules($rulesArr);
            $request->message($messageArr);
            $statusValidate = $request->validate();

            if($statusValidate){
                $dataProduct = $this->model->getProduct($id);
                $dataPost = $request->getFields();
                if($dataPost['upload']['error'] == 4){
                    $image = $dataProduct['image'];
                } else {
                    $image = uniqid(time()). '-' . $dataPost['upload']['name'];
                }

                $dataUpdate = [
                    'proName' => $dataPost['proName'],
                    'idCategory' => $dataPost['idCategory'],
                    'idBrand' => $dataPost['idBrand'],
                    'proPrice' => $dataPost['proPrice'],
                    'image' => $image,
                    'description' => $dataPost['description'],
                    'type' => $dataPost['type'],
                ];

                if(!empty($dataPost['upload']['name'])){
                    $file_tmp = $dataPost['upload']['tmp_name'];
                    unlink(_DIR_ROOT . '/public/uploads/' . $dataProduct['image']);
                    $statusUpload = move_uploaded_file($file_tmp, _DIR_ROOT . '/public/uploads/'. $image);
                    if(!$statusUpload){
                        Session::flashData('warning_product', 'Hệ thống đang bị lỗi. Vui lòng thử lại sau!');
                        
                    }
                }
                
                $statusUpdate = $this->model->updateProduct($id, $dataUpdate);
                if($statusUpdate){
                    Session::flashData('success_product', 'Cập nhật sản phẩm thành công.');
                    $response->redirect(_WEB_ROOT . '/admin/products/showProducts');
                    die();
                } else {
                    Session::flashData('warning_product', 'Hệ thống đang bị lỗi. Vui lòng thử lại sau!');
                }
            } else {
                Session::flashData('errors_product', $request->getErrors());
                Session::flashData('oldData_product', $request->getFields());
            }

            $response->redirect(_WEB_ROOT . '/admin/products/editProduct/' . $id);
        }
    }

    public function deleteProduct($id){
        $response = new Response();
        $dataProduct = $this->model->getProduct($id);
        $statusDelete = $this->model->deleteProduct($id);
        if($statusDelete){
            unlink(_DIR_ROOT . '/public/uploads/' . $dataProduct['image']);
            Session::flashData('success_product', 'Xóa thành công.');
        } else {
            Session:: flashData('error_product', 'Hệ thống đang bị lỗi. Vui lòng thử lại sau!');
        }

        $response->redirect(_WEB_ROOT . '/admin/products/showProducts');
    }
}