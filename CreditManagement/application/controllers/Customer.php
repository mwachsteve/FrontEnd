<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Customer extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		// $this->load->helper(array('url'));
		$this->load->helper('url');
		$this->load->library('form_validation');
		
	}
	
	
	public function index() {
		$arrContextOptions=array(
    		"ssl"=>array(
        	"verify_peer"=>false,
        	"verify_peer_name"=>false,
   		 ),
		);     
		// request list of customers from Web API 
		$json = file_get_contents('https://localhost:44327/api/customers', false, stream_context_create($arrContextOptions));

		// deserialize data from JSON 
		$customers['data'] = json_decode($json); 
		//print_r($customers);
		$this->load->view('header');
		$this->load->view('customer', $customers);
		$this->load->view('footer');
		
	}

	public function postCustomer(){
		$url = 'https://localhost:44327/api/customers';
		$auto_id = array_rand(range(1,5000), 2);
		$idd = $auto_id[0];
		// $_POST['id']
		$data = array('Id' => $idd, 'Name' => $_POST['name'], 'CreditLimit' => $_POST['creditlimit'], 'PaymentTerms' => $_POST['payterms']);
		$options = array(
    	'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
   		 ),
        'ssl'=>array(
        	'verify_peer'=>false,
        	'verify_peer_name'=>false,
   		 ),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		//redirect('/');
	}

	public function Accounts(){

	$arrContextOptions=array(
    		"ssl"=>array(
        	"verify_peer"=>false,
        	"verify_peer_name"=>false,
   		 ),
		);     
		// request list of customers from Web API 
		$json = file_get_contents('https://localhost:44327/api/customers', false, stream_context_create($arrContextOptions));

		// deserialize data from JSON 
		$customers['data'] = json_decode($json); 
		
		$this->load->view('header');
		$this->load->view('accounts', $customers);
		$this->load->view('footer');

	}


		public function PostAccounts(){

		$arrContextOptions=array(
    		"ssl"=>array(
        	"verify_peer"=>false,
        	"verify_peer_name"=>false,
   		 ),
		);     

		//$id = 1;
		  $id = $_POST['id'];
		// request list of customers from Web API 
		$json = file_get_contents('https://localhost:44327/api/customeraccounts/'.$id, false, stream_context_create($arrContextOptions));

		// deserialize data from JSON 
		$accounts = json_decode($json); 
		
		
		$output='';

		 $output.='
            <div class="box-body" id="dataList" name="dataList">
              <br />
              <br />
        <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
  				<th>AccountNumber</th>
  				<th>Actual Balance</th>
  				<th>Available Balance</th>
  				<th>Credit Limit</th>
  				<th>Action</th>
            </tr>
              <!-- <th>Action</th> -->
            </thead>';
            //$grand_total=0;
        	foreach($accounts as $key=>$row){
                    $Id1 = $row->Id;
                    $AccountNumber = $row->AccountNumber;
                    $AvailableBalance = $row->AvailableBalance;
                    $ActualBalance = $row->ActualBalance;
                    $CreditLimit = $row->CreditLimit;
                    $output.='
                    <tr>
                    <td>'.$Id1.'</td>
                    <td>'.$AccountNumber.'</td>
                    <td>'.$ActualBalance.'</td>
                    <td>'.$AvailableBalance.'</td>
                    <td>'.$CreditLimit.'</td>
                    <td><button type="button" class="btn-success btn-sm">Edit</button> || <button type="button" class="btn btn-danger">Delete</button></td>
                    </tr>';
                }
                // $output.='total: '. $grand_total.'';
                $output.='</table></div>';
                echo $output;

	}

		public function Payments(){

	$arrContextOptions=array(
    		"ssl"=>array(
        	"verify_peer"=>false,
        	"verify_peer_name"=>false,
   		 ),
		);     
		// request list of customers from Web API 
		$json = file_get_contents('https://localhost:44327/api/customers', false, stream_context_create($arrContextOptions));

		// deserialize data from JSON 
		$customers['data'] = json_decode($json); 
		
		$this->load->view('header');
		$this->load->view('payments', $customers);
		$this->load->view('footer');

	}

		public function Accounts1(){

	$arrContextOptions=array(
    		"ssl"=>array(
        	"verify_peer"=>false,
        	"verify_peer_name"=>false,
   		 ),
		);     
		// request list of customers from Web API 
		$json = file_get_contents('https://localhost:44327/api/customers', false, stream_context_create($arrContextOptions));

		// deserialize data from JSON 
		$customers['data'] = json_decode($json); 
		
		$this->load->view('header');
		$this->load->view('accounts', $customers);
		$this->load->view('footer');

	}


		public function PostPayments(){

		$arrContextOptions=array(
    		"ssl"=>array(
        	"verify_peer"=>false,
        	"verify_peer_name"=>false,
   		 ),
		);     

		//$id = 1;
		  $id = $_POST['id'];
		// request list of customers from Web API 
		$json = file_get_contents('https://localhost:44327/api/Payments/'.$id, false, stream_context_create($arrContextOptions));

		// deserialize data from JSON 
		$accounts = json_decode($json); 
		
		
		$output='';
		$output1='';

		 $output.='
            <div class="box-body" id="dataList" name="dataList">
              <br />
              <br />
        <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
  				<th>InvoiceId</th>
  				<th>Amount</th>
  				<th>PayDate</th>
  				<th>DueDate</th>
  				<th>Action</th>
            </tr>
              <!-- <th>Action</th> -->
            </thead>';
            //$grand_total=0;
        	foreach($accounts as $key=>$row){
                    $Id1 = $row->Id;
                    $AccountNumber = $row->InvoiceId;
                    $AvailableBalance = $row->Amount;
                    $ActualBalance = $row->Paydate;
                    $CreditLimit = $row->DueDate;
                    $output.='
                    <tr>
                    <td>'.$Id1.'</td>
                    <td>'.$AccountNumber.'</td>
                    <td>'.$AvailableBalance.'</td>
                    <td>'.$ActualBalance.'</td>
                    <td>'.$CreditLimit.'</td>
                    <td><button type="button" class="btn-success btn-sm">Edit</button> || <button type="button" class="btn btn-danger">Delete</button></td>
                    </tr>';
                }
                // $output.='total: '. $grand_total.'';
                $output.='</table></div>';
                echo $output;

	}

	public function postacno(){

		$arrContextOptions=array(
    		"ssl"=>array(
        	"verify_peer"=>false,
        	"verify_peer_name"=>false,
   		 ),
		);     

		//$id = 1;
		  $id = $_POST['id'];
		// request list of customers from Web API 
		$json = file_get_contents('https://localhost:44327/api/customeraccounts/'.$id, false, stream_context_create($arrContextOptions));

		// deserialize data from JSON 
		$accounts = json_decode($json); 
		echo $json;
		//print_r($accounts);

	}

	public function makepayments(){

		$url = 'https://localhost:44327/api/MakePayment';
		$date1 = date('d/M/Y H:i:s', strtotime($_POST['paydate']));
		$date2 = date('d/M/Y H:i:s', strtotime($_POST['duedate']));

		$auto_id = array_rand(range(1,5000), 2);
		$idd = $auto_id[0];
		$dat =array(array('Id'=> $_POST['sel_depart'],'ActualBalance'=> $_POST['acno'],'AvailableBalance'=> $_POST['acnoo'],'CreditLimit'=> '0'));
		$data = array('Id' => $idd, 'InvoiceId' => $_POST['invoiceid'], 'Amount' => $_POST['amount'], 'PayDate' => $date1, 'DueDate' => $date2, 'SaleInvoice' =>$dat);
		$options = array(
    	'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
   		 ),
        'ssl'=>array(
        	'verify_peer'=>false,
        	'verify_peer_name'=>false,
   		 ),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

	}

	public function getBalance(){
		$auto_id = array_rand(range(1,5000), 2);
		$idd = $auto_id[0];
		print_r($auto_id[0]);
	}

	public function getinvoice(){
		$this->load->view('header');
		$this->load->view('invoice');
		$this->load->view('footer');

	}
	
}
