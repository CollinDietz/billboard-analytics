<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ScoreCard_model extends CI_Model {

  function GetArtistID($artist_name)
  {
    $Artist_ID = "SELECT artist_id FROM ARTISTS where artist_name=?";
    $results = $this->db->query($Artist_ID, array($artist_name));
    return $results->result_array()[0]['artist_id'];
  }

  function GetChartEntriesStats($artist_id)
  {
    $PerChartStats =
    'SELECT chart_name, count(date), count(distinct date) FROM
      (SELECT date, chart_id FROM CHARTED NATURAL JOIN SONGS WHERE artist_id = ?
        UNION All
       SELECT date, chart_id FROM CHARTED NATURAL JOIN ALBUMS WHERE artist_id = ?)a
       NATURAL JOIN CHARTS GROUP BY chart_name';
    $results = $this->db->query($PerChartStats, array($artist_id,$artist_id));
    $data = $results->result_array();
    $chart_entry_pairs = [];

    foreach ($data as $row) {
      array_push($chart_entry_pairs, array(str_replace("-", " ", $row["chart_name"]), $row["count(date)"]));
    }

    return $chart_entry_pairs;
  }

  function GetAllTimeStats($artist_id)
  {
    $AllTimeDateStats =
    'SELECT count(date), count(distinct date) FROM
    (SELECT date FROM CHARTED NATURAL JOIN SONGS WHERE artist_id = ?
      UNION ALL
     SELECT date FROM CHARTED NATURAL JOIN ALBUMS WHERE artist_id = ?)a';
    $results = $this->db->query($AllTimeDateStats, array($artist_id,$artist_id));
    $results = $results->result_array()[0];
    $RenamedResults = array(
      'NumberOfEntries' => $results['count(date)'],
      'NumberOfWeeks' => $results['count(distinct date)']
    );
    return $RenamedResults;
  }

  function FirstAndLastApperances($artist_id)
  {
    $FirstAndLastApperancePerChart =
    'SELECT chart_name, min(date) as FirstApperance, max(date) as MostRecentApperance
     FROM (SELECT date, chart_id FROM CHARTED NATURAL JOIN SONGS WHERE artist_id = ?
        UNION ALL SELECT date, chart_id FROM CHARTED NATURAL JOIN ALBUMS WHERE artist_id = ?)a
     NATURAL JOIN CHARTS GROUP by chart_id order by min(date) ASC';
    $results = $this->db->query($FirstAndLastApperancePerChart, array($artist_id,$artist_id));
    return $results->result_array();
  }

  function ArtistsSongsFirstAndLastApperances($artist_id)
  {
    $FirstAndLastApperancePerChart =
    'SELECT song_name, chart_name,
    min(date) as FirstAppearance,
    max(date) as MostRecentApperance,
    count(DISTINCT date) as WeeksOnChart,
    min(position) as BestRank,
    max(position) as LowestRank
    FROM SONGS NATURAL JOIN CHARTED NATURAL JOIN CHARTS
    WHERE artist_id = ?
    GROUP BY song_name, chart_name';
    $results = $this->db->query($FirstAndLastApperancePerChart, array($artist_id));
    $results = $results->result_array();
    return $results;
  }

  function ArtistsAlbumsFirstAndLastApperances($artist_id)
  {
    $FirstAndLastApperancePerChart =
    'SELECT album_name, chart_name,
    min(date) as FirstAppearance,
    max(date) as MostRecentApperance,
    count(DISTINCT date) as WeeksOnChart,
    min(position) as BestRank,
    max(position) as LowestRank
    FROM ALBUMS NATURAL JOIN CHARTED NATURAL JOIN CHARTS
    WHERE artist_id = ?
    GROUP BY album_name, chart_name';
    $results = $this->db->query($FirstAndLastApperancePerChart, array($artist_id));
    $results = $results->result_array();
    return $results;
  }
}
