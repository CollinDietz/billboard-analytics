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

  $artist_name = str_replace("_", " ",$parameter1);

  $this->load->model("Scorecard_model");
  $results = $this->Scorecard_model->GetArtistID($artist_name);
  $artist_id = $results[0]['artist_id'];

  $results = $this->Scorecard_model->GetChartEntriesStats($artist_id);
  $this->load->view("Scorecard_Artist",
   array(
     'artist_name' => $artist_name,
     'data' => $results
   ));
}

}

?>
