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
    $IsAlbums = FALSE;
    $entry_identifier = "Track Name";
  }
  elseif ($entry_type == "album")
  {
    $IsAlbums = TRUE;
    $entry_identifier = "Album Name";
  }

  $view_vars = array(
    "chart"=>$chart,
    "page_title" => ucwords(str_replace("-", " ", $chart_name)),
    "entry_type"=>$entry_identifier,
    "IsAlbums"=>$IsAlbums,
    "chart_name"=>$chart_name,
    "chart_name_norm"=>ucwords(str_replace("-", " ", $chart_name)),
    "date"=>$date,
    "charts_list"=>$this->Chart_model->get_all_chart_names());

  $this->load->template("Chart_view",$view_vars);
}

public function index()
{
  $this->load->model("Chart_model");
  $chart_id = $this->Chart_model->get_chart_id_and_type("billboard-200")[0]["chart_id"];
  $date = $this->Chart_model->get_max_date($chart_id);
  $this->view("billboard-200", $date);
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
