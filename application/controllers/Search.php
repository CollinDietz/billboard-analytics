<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

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
  if(!array_key_exists("q", $_GET))
  {
    redirect(site_url());
  }
  else
  {
    $query = $_GET['q'];
    $this->load->model("Search_model");
    if(!array_key_exists("num_artist", $_GET))
    {
      $num_artists = 10;
    }
    else
    {
      $num_artists = intval($_GET['num_artist']);
    }

    if(!array_key_exists("num_album", $_GET))
    {
      $num_albums = 10;
    }
    else
    {
      $num_albums = intval($_GET['num_album']);
    }

    if(!array_key_exists("num_song", $_GET))
    {
      $num_songs = 10;
    }
    else
    {
      $num_songs = intval($_GET['num_song']);
    }

    if(!array_key_exists("num_chart", $_GET))
    {
      $num_charts = 10;
    }
    else
    {
      $num_charts = intval($_GET['num_chart']);
    }

    $ArtistResults = $this->Search_model->SearchArtists($query, $num_artists);
    $AlbumsResults = $this->Search_model->SearchAlbums($query, $num_albums);
    $SongsResults = $this->Search_model->SearchSongs($query, $num_songs);
    $ChartsResults = $this->Search_model->SearchCharts($query, $num_charts);


    $this->load->template("SearchResults",
     array(
       'query' => $query,
       'ArtistResults' => $ArtistResults,
       'AlbumsResults' => $AlbumsResults,
       'SongsResults' => $SongsResults,
       'ChartsResults' => $ChartsResults,
       'num_artist' => $num_artists,
       'num_album' => $num_albums,
       'num_song' => $num_songs,
       'num_chart' => $num_charts,
       'page_title' => "Search for \"".$query."\""
     ));
  }
}

}
