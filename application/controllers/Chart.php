<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends CI_Controller {

function __construct()
{
        parent::__construct();

/* Standard Libraries of codeigniter are required */
$this->load->database();
$this->load->helper('url');
/* ------------------ */
}

public function view($parameter1 = NULL, $parameter2 = NULL)
{

  if ($parameter1 == NULL || $parameter2 == NULL)
  {
    show_404();
  }

  $chart_name = $parameter1;
  $date = $parameter2;
  $this->load->model("Chart_model");

  $query = $this->Chart_model->get_chart_id_and_type($chart_name);

  $chart_id = $query[0]["chart_id"];
  $entry_type = $query[0]["entry_type"];

  $chart = $this->Chart_model->get_chart_entries_for_date($chart_id, $date, $entry_type);

  if ($entry_type == "track")
  {
    $entry_identifier = "Track Name";
  }
  elseif ($entry_type == "album")
  {
    $entry_identifier = "Album Name";
  }

  $view_vars = array(
    "chart"=>$chart,
    "entry_type"=>$entry_identifier,
    "chart_name"=>$chart_name,
    "date"=>$date,
    "charts_list"=>$this->Chart_model->get_all_chart_names());

  $this->load->view("Chart_view",$view_vars);
}

public function index()
{
  redirect(site_url("chart/view/billboard-200/2018-10-27"));
}

public function chart_pick()
{
  $chart_name = $_POST['chart'];
  $date = date("Y-m-d", strtotime($_POST['date']));
  redirect(site_url("chart/view/$chart_name/$date"));
}
}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
