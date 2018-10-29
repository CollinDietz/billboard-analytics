<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

function __construct()
{
        parent::__construct();

/* Standard Libraries of codeigniter are required */
$this->load->database();
$this->load->helper('url');
/* ------------------ */

$this->load->library('grocery_CRUD');

}

function index()
{
$this->load->view("landing_page");
}

public function artists()
{
$crud = new grocery_CRUD();
$crud->set_table('ARTISTS');
$output = $crud->render();

$this->view_grocerycrud($output);
}

public function songs()
{
$crud = new grocery_CRUD();
$crud->set_table('SONGS');
$output = $crud->render();

$this->view_grocerycrud($output);
}

public function albums()
{
$crud = new grocery_CRUD();
$crud->set_table('ALBUMS');
$output = $crud->render();

$this->view_grocerycrud($output);
}

public function charts()
{
$crud = new grocery_CRUD();
$crud->set_table('CHARTS');
$output = $crud->render();

$this->view_grocerycrud($output);
}

public function charted()
{
//$output = $this->db->query('SELECT * FROM SONGS JOIN CHARTED ON SONGS.id=CHARTED.song_id');
$crud = new grocery_CRUD();
$crud->set_table('CHARTED');
$output = $crud->render();

$this->view_grocerycrud($output);
}

function view_grocerycrud($output = null)
{
$this->load->view('grocery_crud_view.php',$output);
}

}

?>
