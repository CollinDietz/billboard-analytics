<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

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
  if(!isset($_POST["url"]))
  {
    show_404();
  }
  else
  {
    $this->load->model("Report_model");
    if(isset($_SESSION["user"]))
    {
      $this->Report_model->SubmitReport($_POST["url"], $_POST["info"], $_SESSION["user"]);
    }
    else
    {
      $this->Report_model->SubmitReport($_POST["url"], $_POST["info"], NULL);
    }
    redirect($_SESSION['pageHistory'][0]);
  }
}

}
