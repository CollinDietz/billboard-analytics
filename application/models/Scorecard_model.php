<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ScoreCard_model extends CI_Model {

  function GetArtistID($artist_name)
  {
    $Artist_ID = "SELECT artist_id FROM ARTISTS where artist_name=?";
    $results = $this->db->query($Artist_ID, array($artist_name));
    return $results->result_array();
  }

  function GetChartEntriesStats($artist_id)
  {
    $PerChartStats = 'SELECT chart_name, count(date), count(distinct date), avg(position) FROM (SELECT date, position, chart_id FROM CHARTED NATURAL JOIN SONGS WHERE artist_id = ? UNION SELECT date, position, chart_id FROM CHARTED NATURAL JOIN ALBUMS WHERE artist_id = ?)a NATURAL JOIN CHARTS GROUP BY chart_name';
    $results = $this->db->query($PerChartStats, array($artist_id,$artist_id));
    $data = $results->result_array();
    $chart_entry_pairs = [];

    foreach ($data as $row) {
      array_push($chart_entry_pairs, array(str_replace("-", " ", $row["chart_name"]), $row["count(date)"]));
    }

    return $chart_entry_pairs;
  }
}
