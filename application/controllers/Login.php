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
      $this->load->view("Login_view", array("message" => "", "button_text" => "Login"));
    }
    else
    {

      $this->load->model("Login_model");
      $status = $this->Login_model->CheckPasswordForUserName($_POST["InputUsername"], $_POST["InputPassword"]);
      if($status)
      {
        $this->load->view("login_success");
      }
      else
      {
        $this->load->view("Login_view", array("message" => "Failed"));
      }
    }
  }

  function register()
  {
    if(count($_POST) == 0)
    {
      $this->load->view("Register_view", array("message" => "", "button_text" => "Register"));
    }
    else
    {
      $this->load->model("Login_model");
      $status =  $this->Login_model->InsertUser($_POST["InputUsername"], $_POST["InputPassword"]);
      if($status)
      {
        $this->load->view("register_success");
      }
      else
      {
        $this->load->view("Register_view", array("message" => "Failed", "button_text" => "Register"));
      }
    }
  }
}
