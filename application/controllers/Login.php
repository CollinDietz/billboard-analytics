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
    $this->load->view("Login_view", array("status" => TRUE));
  }

  function failed()
  {
    $this->load->view("Login_view", array("status" => FALSE));
  }

  function register()
  {
    $this->load->view("Register_view");
  }

  function register_user()
  {
    $local_db = $this->load->database('accounts', TRUE);
    $local_db->query(
      "INSERT INTO Accounts (Username, Password) VALUES (?,?)",
     array($_POST['InputUsername'], $_POST['InputPassword']));
     redirect(site_url('/login'));
  }

  public function login_user()
  {
    $local_db = $this->load->database('accounts', TRUE);
    $results = $local_db->query("SELECT Password FROM Accounts WHERE Username=?", array($_POST['InputUsername']));

    if(sizeof($results->result_array()) == 0)
    {
      redirect(site_url());
    }
    else
    {
      $password = $results->result_array()[0]["Password"];
      if($password != $_POST['InputPassword'])
      {
        redirect(site_url("login/failed"));
      }
    }
    redirect(site_url("login/login_success"));
  }

  public function login_success()
  {
    $this->load->view("login_success");
  }
}
