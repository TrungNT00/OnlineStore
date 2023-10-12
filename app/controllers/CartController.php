<?php
//CartController Controller 
class CartController extends Controller{
    private $data = [], $model = null;

    public function __construct(){
        $this->model = $this->model('CartModel');
    }

    public function index(){
        $totalPrice = 0;
        $session_id = session_id();
        $dataCart = $this->model->getAllCarts($session_id);

        foreach($dataCart as $key => $cart){
            $totalPrice += $cart['proPrice'] * $cart['quantity'];
        }

        Session::data('totalPrice', $totalPrice);

        if(!empty(Session::data('customer'))){
            $customerInfo = Session::data('customer');
            $this->data['header']['customer'] = $customerInfo;
        }
        $this->data['body'] = 'clients/cart';
        $this->data['header']['title'] = 'Giỏ hàng';
        $this->data['header']['totalPrice'] = $totalPrice;
        $this->data['sub_data']['data'] = $dataCart;
        $this->view('layouts/clients.layout', $this->data);
    }

    public function add(){
        $request = new Request();
        $response = new Response();
        
        if(!empty(Session::data('customer'))){
            if($request->isPost()){
                $session_id = session_id();
                $dataPost = $request->getFields();
                $rulesArr = [
                    'proQuantity' => 'required|minNum:0|',
                ];
    
                $messagesArr = [
                    'proQuantity.required' => '* Số lượng không được để trống!',
                    'proQuantity.minNum' => '* Số lượng là số nguyên dương'
                ];
    
                $request->rules($rulesArr);
                $request->message($messagesArr);
                $statusValidate = $request->validate();
    
                if($statusValidate){
                    $checkExist = $this->db->query("SELECT idCart FROM tbl_cart WHERE idSession = '$session_id' AND idProduct = ".$dataPost["idProduct"], [], true)->rowCount();
                    $sumCart = $this->db->query("SELECT idCart FROM tbl_cart WHERE idSession = '$session_id'", [], true)->rowCount();
                    if($checkExist > 0){
                        $dataProExist = $this->model->getCartByPro($dataPost['idProduct'], $session_id);
                        $newQuantity = $dataProExist['quantity'] + $dataPost['proQuantity'];
                        $dataUpdate = [
                            'quantity' =>  $newQuantity
                        ];
                        
                        $statusUpdate = $this->model->updateCart($session_id, $dataPost['idProduct'], $dataUpdate);
                        $response->redirect(_WEB_ROOT . '/cart');
                        
                    } else {
                        $dataProduct = $this->db->table('tbl_product')->where('idProduct', '=', $dataPost['idProduct'])->first();
                        $dataInsert = [
                            'idProduct' => $dataPost['idProduct'],
                            'idSession' => $session_id,
                            'proName' => $dataProduct['proName'],
                            'proPrice' => $dataProduct['proPrice'],
                            'quantity' => $dataPost['proQuantity'],
                            'image' => $dataProduct['image']
                        ];

                        $statusInsert = $this->model->insertCart($dataInsert);
                        if($statusInsert){
                            $response->redirect(_WEB_ROOT . '/cart');    
                            die();
                        } else {
                            Session::flashData('warning_cart', 'Hệ thống đang gặp lỗi. Vui lòng thử lại sau!');
                        }
                    }
                } else {
                    Session::flashData('error_cart', $request->getErrors());
                }
                $response->redirect(_WEB_ROOT . '/detailProduct-' . $dataPost['idProduct']);
            }
        } else {
            $response->redirect(_WEB_ROOT . '/user');
        }
    }

    public function orderDetail(){
        if(!empty(Session::data('customer'))){
            $customerInfo = Session::data('customer');
            $this->data['customer'] = $customerInfo;
        }
        $this->data['body'] = 'clients/orderDetail';
        $this->view('layouts/clients.layout', $this->data);
    }

    public function minusPro($id){
        $response = new Response();
        $session_id = session_id();
        $dataCart = $this->model->getCartByPro($id, $session_id);
        if($dataCart['quantity'] <= 1){
            $minusPro = 1;
        } else {
            $minusPro = $dataCart['quantity'] - 1;
        }
        $dataUpdate = [
            'quantity' => $minusPro
        ];
        $this->model->updateCart($session_id, $id, $dataUpdate);
        $response->redirect(_WEB_ROOT . '/cart');
    }

    public function plusPro($id){
        $response = new Response();
        $session_id = session_id();
        $dataCart = $this->model->getCartByPro($id, $session_id);
        $plusPro = $dataCart['quantity'] + 1;
        $dataUpdate = [
            'quantity' => $plusPro
        ];
        $this->model->updateCart($session_id, $id, $dataUpdate);
        $response->redirect(_WEB_ROOT . '/cart');
    }

    public function delete($id){
        $session_id = session_id();
        $response = new Response();
        $statusDelete = $this->model->deleteCart($session_id, $id);
        $response->redirect(_WEB_ROOT . '/cart');
    }
}