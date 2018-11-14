<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search_model extends CI_Model
{
  function SearchArtists($ArtistName, $size)
  {
    $query = "SELECT artist_name FROM ARTISTS WHERE artist_name LIKE ? LIMIT 0, ?";
    $results = $this->db->query($query, array("%".$ArtistName."%", $size));
    return $results->result_array();
  }

  function SearchCharts($ChartName, $size)
  {
    $query = "SELECT chart_name FROM CHARTS WHERE chart_name LIKE ? LIMIT 0, ?";
    $results = $this->db->query($query, array("%".$ChartName."%", $size));
    return $results->result_array();
  }

  function SearchSongs($SongName, $size)
  {
    $query = "SELECT song_name, artist_name FROM SONGS NATURAL JOIN ARTISTS WHERE song_name LIKE ? LIMIT 0, ?";
    $results = $this->db->query($query, array("%".$SongName."%", $size));
    return $results->result_array();
  }

  function SearchAlbums($AlbumName, $size)
  {
    $query = "SELECT album_name, artist_name FROM ALBUMS NATURAL JOIN ARTISTS WHERE album_name LIKE ? LIMIT 0, ?";
    $results = $this->db->query($query, array("%".$AlbumName."%", $size));
    return $results->result_array();
  }
}
