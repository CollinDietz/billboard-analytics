<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chart_model extends CI_Model {

  function get_chart_id_and_type($chart_name)
  {
    $get_chart_id_and_type = "SELECT chart_id, entry_type FROM CHARTS WHERE chart_name=?";
    $query = $this->db->query($get_chart_id_and_type, array($chart_name));
    return $query->result_array();
  }

  function get_chart_entries_for_date($chart_id, $date, $entry_type)
  {
    if ($entry_type == "track")
    {
      $local_query_vals = array('song_name', "song_id", "SONGS");
    }
    elseif ($entry_type == "album")
    {
      $local_query_vals = array("album_name", "album_id", "ALBUMS");
    }

    $query_vals = array(intval($chart_id), $date);
    $get_chart_entries_for_date = "SELECT position, $local_query_vals[0], artist_name FROM (SELECT position, $local_query_vals[1] FROM CHARTED WHERE chart_id=? AND date=?)chart_songs NATURAL JOIN $local_query_vals[2] NATURAL JOIN ARTISTS;";
    $query = $this->db->query($get_chart_entries_for_date, $query_vals);

    return $query->result_array();
  }

  function get_all_chart_names()
  {
   $get_chart_names = "SELECT chart_name FROM CHARTS";
   $result = $this->db->query($get_chart_names)->result_array();
   foreach ($result as $key => $value)
   {
     $result[$key]["chart_name"] = ucwords(str_replace("-", " ", $value["chart_name"]));
   }
   return $result;
  }

  function get_max_date($chart_id)
  {
    $max_date = 'SELECT MAX(DATE) FROM CHARTED WHERE chart_id = ?';
    $result = $this->db->query($max_date, array($chart_id))->result_array()[0]["MAX(DATE)"];
    return $result;
  }

  function get_surrounding_dates($date, $chart_id)
  {
    $date_above = 'SELECT MIN(date) FROM CHARTED WHERE date > ? AND chart_id = ?';
    $result = $this->db->query($date_above, array($date, $chart_id))->result_array();
    if(count($result) != 0)
    {
      $next_week = $result[0]['MIN(date)'];
    }

    $date_below = 'SELECT MAX(date) FROM CHARTED WHERE date < ? AND chart_id = ?';
    $result = $this->db->query($date_below, array($date, $chart_id))->result_array();
    if(count($result) != 0)
    {
      $prev_week = $result[0]['MAX(date)'];
    }

    return array("next_week" => $next_week, "prev_week" => $prev_week);
  }

}

?>
