<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class User extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->library('session');
		$this->load->helper(array('url'));
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->library('form_validation');
		//$this->load->view('header');
//$this->load->view('user/login/login.php');
	//$this->load->view('user/register/register');
	//$this->load->view('header');
	//$this->load->view('footer');
		
	}
	
	
	public function index() {
		
	$this->load->view('user/login/login');
		
	}

		public function index_otp() {
		
	$this->load->view('user/otp/index_otp');
		
	}

	public function processEmailVerification()
    {
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
        switch ($_POST["action"]) {
            
            case "get_otp":
                $email = $_POST['email'];
                $otp = rand(100000, 999999); //generates random otp
                $_SESSION['session_otp'] = $otp;
                $this->session->set_userdata('session_otp', $otp);
                $message = "Your one time email verification code is" . $otp;
                echo $this->session->userdata('session_otp');
                $sub = "Email verification from Dj Techblog";
                $headers = "From : " . "mwachsteve@gmail.com";
                $data['data'] =$this->session->userdata('session_otp');
                $this->otp_verification();
                // redirect('otp_verification', $data);
                // redirect(base_url('/otp_verification'), $data);
                // try{
                //     $retval = mail($email,$sub,$message);
                //     if($retval)
                //     {
                //         //require_once('otp-verification.php');
                //         redirect('user/otp_verification');
                //     }
                // }
                
                // catch(Exception $e)
                // {
                //     die('Error: '.$e->getMessage());
                // }
 
                break;
                
            case "verify_otp":
                $otp = $_POST['otp'];
                // echo $_SESSION['session_otp'];
                echo "check session" . $this->session->userdata('session_otp');
                
                if ($otp == $_SESSION['session_otp']) 
                {
                   unset($_SESSION['session_otp']);
                   echo json_encode(array("type"=>"success", "message"=>"Your Email is verified!"));
                } 
                else {
                    echo json_encode(array("type"=>"error", "message"=>"Mobile Email verification failed"));
                }
                break;
        }
    }

    public function otp_verification(){
	$this->load->view('user/otp/index_otp1');

    }
// }
	
	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() {
		
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		
		if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('user/register/register', $data);
			$this->load->view('footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->user_model->create_user($username, $email, $password)) {
				
				// user creation ok
				$this->load->view('header');
				$this->load->view('user/register/register_success', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('user/register/register', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
		
	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
	public function login() {
		
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('header');
			$this->load->view('form_view');
			$this->load->view('footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($username, $password)) {
				
				$user_id = $this->user_model->get_user_id_from_username($username);
				$user    = $this->user_model->get_user($user_id);
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->id;
				$_SESSION['username']     = (string)$user->username;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
				$_SESSION['is_admin']     = (bool)$user->is_admin;
				
				// user login ok
				//$this->load->view('header');
				//$this->load->view('form_view', $data);
				//$this->load->view('footer');
				redirect( base_url('form_view') );
				
			} else {
				
				// login failed
				$data->error = 'Wrong username or password.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('user/login/login', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	
	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout() {
		
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			$this->load->view('header');
			$this->load->view('user/logout/logout_success', $data);
			$this->load->view('footer');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
			
		}
		
	}
	
}
