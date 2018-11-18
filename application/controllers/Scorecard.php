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

function _GetNameOfElementAndArtist($param1, $param2)
{
  $data = array();
  if(isset($_GET["name"]))
  {
    $data['name'] = urldecode($_GET["name"]);
  }
  else if($param1 != NULL)
  {
    $data['name'] = str_replace("_", " ",$param1);
  }
  else
  {
    return FALSE;
  }

  if(isset($_GET["by"]))
  {
    $data['artist_name'] = urldecode($_GET["by"]);
  }
  else if($param2 != NULL)
  {
    $data['artist_name'] = str_replace("_", " ",$param2);
  }
  else
  {
    return FALSE;
  }

  return $data;
}

function _GetNameOfElement($param1)
{
  $data = array();
  if(isset($_GET["name"]))
  {
    $data['name'] = urldecode($_GET["name"]);
  }
  else if($param1 != NULL)
  {
    $data['name'] = str_replace("_", " ",$param1);
  }
  else
  {
    return FALSE;
  }

  return $data['name'];
}

function Artist($parameter1 = null)
{
  if(($artist_name = $this->_GetNameOfElement($parameter1)) == FALSE)
  {
    show_404();
  }

  $this->load->model("Scorecard_model");
  $artist_id = $this->Scorecard_model->GetArtistID($artist_name);

  if(isset($_POST["action"]) && isset($_SESSION["user"]))
  {
    $this->load->model("UserData_model");
    if($_POST["action"] == "favorite")
    {
      $this->UserData_model->FavoriteArtist($_SESSION["user"], $artist_id);
    }
    else if($_POST["action"] == "unfavorite")
    {
      $this->UserData_model->UnfavoriteArtist($_SESSION["user"], $artist_id);
    }
  }

  $results = $this->Scorecard_model->GetChartEntriesStats($artist_id);
  $AllTimeChartsStats = $this->Scorecard_model->GetAllTimeStats($artist_id);
  $ChartApperances = $this->Scorecard_model->FirstAndLastApperances($artist_id);
  $SongApperancesStats = $this->Scorecard_model->ArtistsSongsFirstAndLastApperances($artist_id);
  $AlbumApperancesStats = $this->Scorecard_model->ArtistsAlbumsFirstAndLastApperances($artist_id);

  $IsFavorite = TRUE;
  if(isset($_SESSION["user"]))
  {
    $this->load->model("UserData_model");
    $IsFavorite = $this->UserData_model->IsArtistAUserFavorite($_SESSION["user"], $artist_id);
  }

  $this->load->template("Scorecard_Artist",
   array(
     'artist_name' => $artist_name,
     'data' => $results,
     'AllTimeChartsStats' => $AllTimeChartsStats,
     'ChartApperancesStats' => $ChartApperances,
     'AlbumApperancesStats' => $AlbumApperancesStats,
     'SongApperancesStats' => $SongApperancesStats,
     'IsFavorite' => $IsFavorite
   ));
}

function Song($parameter1 = null, $parameter2 = null)
{
  if(($data = $this->_GetNameOfElementAndArtist($parameter1, $parameter2)) == FALSE)
  {
    show_404();
  }

  $this->load->template("Scorecard_SongsAndAlbums", $data);

}

function Album($parameter1 = null, $parameter2 = null)
{
  if(($data = $this->_GetNameOfElementAndArtist($parameter1, $parameter2)) == FALSE)
  {
    show_404();
  }

  $this->load->template("Scorecard_SongsAndAlbums", $data);
}


}

?>
