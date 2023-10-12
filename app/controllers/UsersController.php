<?php
//UsersController Controller 
class UsersController extends Controller
{
    private $data = [], $model = null, $modelCart = null, $modelUser = null;

    public function __construct()
    {
       $this->model = $this->model('CustomerModel');
       $this->modelCart = $this->model('CartModel');
    }

    public function index()
    {
        $response =  new Response();
        if(!empty(Session::data('customer_login'))){
            $response->redirect(_WEB_ROOT);
        } else {
            $this->login();
        }
    }

    public function login(){
        $this->data['body'] = 'clients/login';
        $this->data['header']['title'] = 'Đăng nhập';
        $this->data['sub_data']['errors'] = Session::flashData('error');
        $this->data['sub_data']['oldData'] = Session::flashData('old');
        $this->data['sub_data']['errors_signup'] = Session::flashData('errors_signup');
        $this->data['sub_data']['oldData_signup'] = Session::flashData('oldData_signup');
        $this->data['sub_data']['success'] = Session::flashData('success');
        $this->view('layouts/clients.layout', $this->data);
    }

    public function handleLogin()
    {
        $request = new Request();
        $response = new Response();

        $dataCustomers = $this->model->getCustomers();

        $rulesArr = [
            'email_login' => 'required|email|uniqueLogin:tbl_customer:cusEmail',
            'password_login' => 'required|check:tbl_customer:password:cusEmail:email_login'
        ];

        $messageArr = [
            'email_login.required' => '* Email không để trống',
            'email_login.email' => '* Email không hợp lệ',
            'email_login.uniqueLogin' => '* Email không đúng',
            'password_login.required' => '* Mật khẩu không để trống',
            'password_login.check' => '* Mật khẩu không đúng',
        ];

        $request->rules($rulesArr);
        $request->message($messageArr);
        $statusLogin = $request->validate();

        if($statusLogin){
            if(!empty($dataCustomers)){
                foreach($dataCustomers as $key => $customer){
                    if(trim($request->getFields()['email_login']) == trim($customer['cusEmail'])){
                        Session::data('customer_login', $customer['cusName']);
                        Session::data('customer', $customer);
                        $response->redirect(_WEB_ROOT);
                    }
                }
            }
        } else {
            Session::flashData('error', $request->getErrors());
            Session::flashData('old', $request->getFields());
            $response->redirect(_WEB_ROOT . '/user/login');
        }

    }

    public function logout(){
        $response = new Response();
        if (!empty(Session::data('customer_login'))) {
            Session::delete();
            $response->redirect(_WEB_ROOT);
        }
    }

    public function signup(){
        $request = new Request();
        $response = new Response();

        $rulesArr = [
            'cusName' => 'required|min:3|max:20',
            'cusEmail' => 'required|email|uniqueExisted:tbl_customer:cusEmail',
            'address' => 'required',
            'country' => 'required',
            'phone' => 'required|phone',
            'password' => 'required|min:5|max:10',
            're_password' => 'required|matched:password',
        ];

        $messageArr = [
            'cusName.required' => '* Tên không để trống',
            'cusName.min' => '* Tên tối thiểu 3 kí tự',
            'cusName.max' => '* Tên tối đa 20 kí tự',
            'cusEmail.required' => '* Email không để trống',
            'cusEmail.email' => '* Email không hợp lệ',
            'cusEmail.uniqueExisted' => '* Email đã tồn tại',
            'address.required' => '* Địa chỉ không để trống',
            'country.required' => '* Tỉnh/Thành phố không để trống',
            'phone.required' => '* Số điện thoại không để trống',
            'phone.phone' => '* Số điện thoại không hợp lệ',
            'password.required' => '* Mật khẩu không để trống',
            'password.min' => '* Mật khẩu tối thiểu 3 kí tự',
            'password.max' => '* Mật khẩu tối đa 10 kí tự',
            're_password.required' => '* Mật khẩu không để trống',
            're_password.matched' => '* Mật khẩu không khớp',
        ];

        $request->rules($rulesArr);
        $request->message($messageArr);
        $statusSignup = $request->validate();

        if($statusSignup){
            $dataPost = $request->getFields();
            $dataInsert = [
                'cusName' => $dataPost['cusName'],
                'cusEmail' => $dataPost['cusEmail'],
                'address' => $dataPost['address'],
                'country' => $dataPost['country'],
                'phone' => $dataPost['phone'],
                'password' => md5($dataPost['password']),
            ];
            $statusInsert = $this->model->insertCustomer($dataInsert);
            if($statusInsert){
                Session::flashData('success', 'Đăng ký thành công.');
            }
        }  else {
            Session::flashData('oldData_signup', $request->getFields());
            Session::flashData('errors_signup', $request->getErrors());
        }
        
        $response->redirect(_WEB_ROOT . '/user/login');
    }

    public function profile(){
        if(!empty(Session::data('customer'))){
            $customerInfo = Session::data('customer');
            $this->data['header']['customer'] = $customerInfo;
            $this->data['sub_data']['customer'] = $customerInfo;
        }
        $this->data['body'] = 'clients/profile';
        $this->data['header']['totalPrice'] = Session::data('totalPrice');
        $this->data['header']['title'] = 'Thông tin khách hàng';
        $this->view('layouts/clients.layout', $this->data);
    }

    public function editProfile($id){
        if(!empty(Session::data('customer'))){
            $customerInfo = Session::data('customer');
            $this->data['customer'] = $customerInfo;
            $this->data['sub_data']['customer'] = $customerInfo;
        }
        $this->data['body'] = 'clients/editProfile';
        $this->view('layouts/clients.layout', $this->data);
    }

    public function handleEditProfile($id){
        $request = new Request();
        $response = new Response();
        if($request->isPost()){
            $dataPost = $request->getFields();
            $dataUpdate = [
                'cusName' => $dataPost['cusName'],
                'cusEmail' => $dataPost['cusEmail'],
                'address' => $dataPost['address'],
                'country' => $dataPost['country'],
                'phone' => $dataPost['phone'],
            ];
            $this->model->updateCustomer($id, $dataUpdate);
            $response->redirect(_WEB_ROOT . '/user/profile');
        }
    }

}
