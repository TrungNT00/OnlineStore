<?php
//PaymentController Controller 
class PaymentController extends Controller{
    private $data = [], $model = null, $modelCus = null, $modelCart = null, $modelPro = null;

    public function __construct(){
        $this->model = $this->model('PaymentModel');
        $this->modelCus = $this->model('CustomerModel');
        $this->modelCart = $this->model('CartModel');
        $this->modelPro = $this->model('ProductsModel');
    }

    public function index(){
        $response = new Response();
        $session_id = session_id();
        $dataCus = Session::data('customer');
        $dataCarts = $this->modelCart->getAllCarts($session_id);
        if(!empty(Session::data('customer'))){
            $customerInfo = Session::data('customer');
            $this->data['header']['customer'] = $customerInfo;
            $this->data['body'] = 'clients/payment';
            $this->data['header']['title'] = 'Đặt hàng';
            $this->data['header']['totalPrice'] = Session::data('totalPrice');
            $this->data['sub_data']['datas'] = $dataCarts;
            $this->data['sub_data']['dataCus'] = $dataCus;
            $this->view('layouts/clients.layout', $this->data);
        } else {
            $response->redirect(_WEB_ROOT . '/user');
        }
    }

    public function showOrders(){
        
    }

    public function addOrder(){
        $request = new Request();
        $response = new Response();
        $dataProPost = [];
        $dataQuantiyPost = [];
        if($request->isPost()){
            $dataPost = $request->getFields();
            $dataIdPro = $dataPost['idProduct'];
            $dataQuantity = $dataPost['quantity'];
            $idCus = $dataPost['idCustomer'];

            foreach($dataIdPro as $key => $pro){
                $dataPro = $this->modelPro->getProduct($pro);
                $dataProPost[$key] = $dataPro;
            }

            foreach($dataQuantity as $key => $quantity){
                $dataQuantiyPost[$key] = $quantity;
            }

            $countPro = count($dataProPost);

            for($i = 0; $i < $countPro; $i++){
                $totalPrice = $dataProPost[$i]['proPrice'] * $dataQuantiyPost[$i];
                $dataInsert = [
                    'idCustomer' => $idCus,
                    'idProduct' => $dataProPost[$i]['idProduct'],
                    'proName' => $dataProPost[$i]['proName'],
                    'quantity' => $dataQuantiyPost[$i],
                    'orderPrice' => $totalPrice,
                    'image' => $dataProPost[$i]['image'],
                    'orderDate' => date('Y-m-d H:i:s'),
                    'status' => 0
                ];
                
                $this->model->insertOrder($dataInsert);
            }
        }
        $response->redirect(_WEB_ROOT . '/payment');
    }

    public function orderDetails(){
        if(!empty(Session::data('customer'))){
            $customer = Session::data('customer');
            $idCus = $customer['idCustomer'];
            $this->data['header']['customer'] = $customer;
        }

        $dataOrders = $this->model->getOrderByCustomer($idCus);
        $this->data['body'] = 'clients/orderDetail';
        $this->data['header']['title'] = 'Chi tiết đặt hàng';
        $this->data['header']['totalPrice'] = Session::data('totalPrice');
        $this->data['sub_data']['datas'] = $dataOrders;
        $this->view('layouts/clients.layout', $this->data);
    }
}