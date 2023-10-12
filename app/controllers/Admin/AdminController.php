<?php
//Admin/AdminController Controller 
class AdminController extends Controller{
    private $data = [], $model = [];

    public function __construct(){
        $this->model = $this->model('AdminModel');
    }

    public function index(){
        // index
    }

    public function handleChangePassword($id){
        $request = new Request();
        $response = new Response();
        $errors = [];
        $check = false;

        if($request->isPost()){
            $dataAdmin = Session::data('adminInfo');
            $dataPost = $request->getFields();
            if(md5(trim($dataPost['oldPass'])) == trim($dataAdmin['adminPass'])){
                if(!empty(trim($dataPost['newPass']))){
                    if(strlen(trim($dataPost['newPass'])) > 3){
                        if(strlen(trim($dataPost['newPass'])) < 10){
                            $check = true;
                        } else {
                            $errors['newPass']['max'] = 'Mật khẩu tối đa 3 kí tự';
                        }
                    } else {
                        $errors['newPass']['min'] = 'Mật khẩu tối thiểu 3 kí tự';
                    }
                } else {
                    $errors['newPass']['required'] = 'Mật khẩu không để trống';
                }
            } else {
                $errors['oldPass']['isPass'] = 'Mật khẩu không đúng';
            }
        }

        if($check == true) {
            $dataUpdate = [
                'adminPass' => md5(trim($dataPost['newPass']))
            ];

            $status = $this->model->updateAdmin($dataAdmin['id_admin'], $dataUpdate);
            if($status){
                Session::flashData('msg_pass', 'Cập nhật mật khẩu thành công');
            }
        } else {
            Session::flashData('errors_pass', $errors);
        }

        $response->redirect(_WEB_ROOT . '/admin/changePassword');
    }

    public function showOrder(){
        echo 'a';
    }
}