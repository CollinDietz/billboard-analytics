<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scorecard extends CI_Controller {

function __construct()
{
        parent::__construct();

/* Standard Libraries of codeigniter are required */
$this->load->database();
$this->load->helper('url');
/* ------------------ */

}

function Artist($parameter1 = null)
{
  if($parameter1 == NULL)
  {
    show_404();
  }

  $artist_name = $parameter1;

  $this->load->view("Scorecard/Artist", array('artist_name' => $artist_name));
}

}

?>
