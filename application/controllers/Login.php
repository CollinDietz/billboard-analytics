<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


  function __construct()
  {
          parent::__construct();

  /* Standard Libraries of codeigniter are required */
  $this->load->database();
  $this->load->helper('url');
  /* ------------------ */
  }

  function index()
  {
    if(count($_POST) == 0)
    {
      $this->load->template("Login_view",
                    array("message" => "",
                          "button_text" => "Login",
                          "page_title" => "Login"
                        ));
    }
    else
    {

      $this->load->model("Login_model");
      $status = $this->Login_model->CheckPasswordForUserName($_POST["InputUsername"], $_POST["InputPassword"]);
      if($status)
      {
        $_SESSION["user"] = $_POST["InputUsername"];
        redirect($_SESSION['pageHistory'][1]);
      }
      else
      {
        $this->load->template("Login_view",
        array("message" => "Failed",
              "button_text" => "Login",
              "page_title" => "Login"
            ));
      }
    }
  }

  function register()
  {
    if(count($_POST) == 0)
    {
      $this->load->template("Register_view",
        array("message" => "",
              "button_text" => "Register",
              "page_title" => "Register"
            ));
    }
    else
    {
      $this->load->model("Login_model");
      $status =  $this->Login_model->InsertUser($_POST["InputUsername"], $_POST["InputPassword"]);
      if($status)
      {
        $_SESSION["user"] = $_POST["InputUsername"];
        redirect($_SESSION['pageHistory'][2]);
      }
      else
      {
        $this->load->template("Register_view",
        array("message" => "Failed",
              "button_text" => "Register",
              "page_title" => "Register"
              ));
      }
    }
  }
}
