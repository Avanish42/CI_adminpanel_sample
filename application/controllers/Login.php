<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this -> load -> helper('url');
        $this -> load -> database();
        $this -> load -> library('form_validation');
        $this -> load -> model('Login_model');

    }

    /**
     *
     */
    public function index()
    {
        $email= $_POST['email'];
        $password=$_POST['password'];
        echo $email,$password;
//

//        if (!empty($this -> session -> userdata) && $this -> session -> userdata!=null && !empty($this -> session -> userdata['email']) ) {
//            $this->load->view('Merchant');
//        }
//        else

           // $usr_result = $this->Login_model->get_user($email, $password);
            //if ($usr_result > 0) //active user record is present

                //set the session variables
                $sessiondata = array(
                    'username' => $email,
                    'loginuser' => TRUE
                );
                $this->session->set_userdata($sessiondata);
                //$this->load->view('Merchant.');
                        redirect('Merchant');
            //else
            {
//                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username or password!</div>');
                 redirect('login/index');
            }

//

    }
    public function login()
    {
        $this -> load -> view('common/head.php');
        $this -> load ->view('login.php');
        $this -> load -> view('common/footer.php');
    }
    public function signup()
    {
        $this -> load -> view('common/head.php');
        $this -> load ->view('signup.php');
        $this -> load -> view('common/footer.php');
    }

    public function signup_Store()
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        $data['name']=$name;
        $data['email']=$email;
        $data['password']=md5($password);
        if($this -> Login_model -> insert_data($data)){
                redirect('Login');
        }
        else{
            redirect('Signup');
        }

    }

    public function forgotpassword()
    {
        $this -> load -> view('common/head.php');
        $this->load ->view('forgotpassword.php');
        $this -> load -> view('common/footer.php');
    }
}

