<?php
//Admin/DashboardController Controller 
class DashboardController extends Controller{
    private $data = [], $model = [], $modelOrder = null, $modelCus = null;

    public function __construct(){
        $this->model = $this->model('AdminModel');
        $this->modelOrder = $this->model('PaymentModel');
        $this->modelCus = $this->model('CustomerModel');
    }
    
    public function index(){
        if(!empty(Session::data('admin_login'))){
            $this->data['body'] = 'admin/dashboard';
            $this->data['sub_data']['adminName'] = Session::data('admin_login');
            $this->view('layouts/admin.layout', $this->data);
        } else {
            $this->data['error_login'] = Session::flashData('error_login');
            $this->data['oldData_login'] = Session::flashData('oldData_login');
            $this->view('admin/login', $this->data);
        }
        
    }

    
    public function dashboard(){
        $this->view('admin/dashboard');
    }

    public function handleLogin(){
        $request = new Request();
        $response = new Response();
        $dataAdmin = $this->model->getAdmins();

        if($request->isPost()){
            $rulesArr = [
                'adminName' => 'required|uniqueLogin:tbl_admin:adminName',
                'adminPass' => 'required|check:tbl_admin:adminPass:adminName:adminName'
            ];

            $messagesArr = [
                'adminName.required' => '* đăng nhập không để trống',
                'adminName.uniqueLogin' => '* Tên đăng nhập không tồn tại',
                'adminPass.required' => '* Mật khẩu không để trống',
                'adminPass.check' => '* Mật khẩu không đúng',
            ];

            $request->rules($rulesArr);
            $request->message($messagesArr);
            $statusValidate = $request->validate();

            if($statusValidate){
                if(!empty($dataAdmin)){
                    foreach($dataAdmin as $key => $admin){
                        if(trim($admin['adminName']) == trim($request->getFields()['adminName']) && trim($admin['adminPass']) == md5(trim($request->getFields()['adminPass']))){
                            Session::data('admin_login', $request->getFields()['adminName']);
                            Session::data('adminInfo', $admin);
                        }
                    }
                }
            } else {
                Session::flashData('error_login', $request->getErrors());
                Session::flashData('oldData_login', $request->getFields());
            }
            $response->redirect(_WEB_ROOT . '/admin');
        }
    }

    public function logout(){
        $response = new Response();
        Session::delete();
        $response->redirect(_WEB_ROOT . '/admin');
    }

    public function changePassword(){
        $response = new Response();
        if(!empty(Session::data('admin_login'))){
            $this->data['body'] = 'admin/changepassword';
            $this->data['sub_data']['adminInfo'] = Session::data('adminInfo');
            $this->data['sub_data']['errors_pass'] = Session::flashData('errors_pass');
            $this->data['sub_data']['msg_pass'] = Session::flashData('msg_pass');
            $this->view('layouts/admin.layout', $this->data);
        }
        $this->index();
    }

    public function handleChangePassword(){
        $response = new Response();
        $response->redirect(_WEB_ROOT . '/admin/changepassword');
    }

    public function showOrders(){
        $dataCustomers = $this->modelCus->getCustomers();
        if(!empty(Session::data('admin_login'))){
            $this->data['body'] = 'admin/payment';
            $this->data['sub_data']['dataCuss'] = $dataCustomers;
            $this->view('layouts/admin.layout', $this->data);
        }
        $this->index();
    }

    public function detailOrder($id){
        $dataProducts = $this->db->table('tbl_product')->get();
        $dataOrders = $this->modelOrder->getOrderByCustomer($id);
        $this->data['body'] = 'admin/detailOrder';
        $this->data['sub_data']['dataOrders'] = $dataOrders;
        $this->data['sub_data']['dataProducts'] = $dataProducts;
        $this->view('layouts/admin.layout', $this->data);
    }

    public function tittle_slogan(){
        $this->data['body'] = 'admin/tittle_slogan';
        $this->view('layouts/admin.layout', $this->data);
    }

    public function social_media(){
        $this->data['body'] = 'admin/socialMedia';
        $this->view('layouts/admin.layout', $this->data);
    }

    public function copyright(){
        $this->data['body'] = 'admin/copyright';
        $this->view('layouts/admin.layout', $this->data);
    }
}