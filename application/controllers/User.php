<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {


  function __construct()
  {
          parent::__construct();

  /* Standard Libraries of codeigniter are required */
  $this->load->database();
  $this->load->helper('url');
  /* ------------------ */
  }

  function favorites()
  {
    if(!isset($_SESSION["user"]))
    {
      redirect(site_url());
    }
    else
    {
      $this->load->model("UserData_model");
      $fav_artists = $this->UserData_model->GetFavorites($_SESSION["user"]);
      $this->load->template("user_favorites", array("fav_artists" => $fav_artists));
    }
  }

  function logout()
  {
    $url = $_SESSION["pageHistory"][0];
    $this->session->sess_destroy();
    redirect($url);
  }

}
