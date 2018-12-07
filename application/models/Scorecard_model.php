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

  function GetAlbumID($album_name, $artist_id)
  {
    $GetID =
    'SELECT album_id
    FROM ALBUMS
    WHERE album_name=? AND artist_id=?';
    $results = $this->db->query($GetID, array($album_name, $artist_id));
    return $results->result_array()[0]["album_id"];
  }

  function GetSongID($song_name, $artist_id)
  {
    $GetID =
    'SELECT song_id
    FROM SONGS
    WHERE song_name=? AND artist_id=?';
    $results = $this->db->query($GetID, array($song_name, $artist_id));
    return $results->result_array()[0]["song_id"];
  }

  function AlbumLifeTimePerformance($album_id)
  {
    $ChartNames =
    'SELECT DISTINCT(chart_name) FROM CHARTED NATURAL JOIN CHARTS
    WHERE album_id=?';
    $charts = $this->db->query($ChartNames, array($album_id))->result_array();

    $MinMaxDates =
    'SELECT MIN(date), MAX(date) FROM CHARTED NATURAL JOIN CHARTS
    WHERE album_id=?';
    $MinMaxDates = $this->db->query($MinMaxDates, array($album_id))->result_array();

    // $AllDates =
    // 'SELECT DISTINCT(date) FROM CHARTED NATURAL JOIN CHARTS where song_id=?';
    // $dates = $this->db->query($AllDates, array($song_id))->result_array();

    $DateRange =
    'SELECT DISTINCT(date) FROM CHARTED WHERE date >= ? and date <= ?';
    $dates = $this->db->query($DateRange, array($MinMaxDates[0]['MIN(date)'], $MinMaxDates[0]['MAX(date)']))->result_array();


    $LifeTimePerformance =
    "SELECT date, position, chart_name
    FROM CHARTED NATURAL JOIN CHARTS
    WHERE album_id=? order by date";
    $results = $this->db->query($LifeTimePerformance, array($album_id));
    $results = $results->result_array();

    $line_chart_data = array();

    foreach ($dates as $date)
    {
      $line_chart_data[$date['date']] = array();
      foreach ($charts as $chart)
      {
        $line_chart_data[$date['date']][$chart['chart_name']] =  "";
      }
    }

    foreach ($dates as $date)
    {
      foreach ($charts as $chart)
      {
        foreach ($results as $result)
        {
          if($result['date'] == $date['date'] && $result['chart_name'] == $chart['chart_name'])
          {
              $line_chart_data[$date['date']][$chart['chart_name']] = -1 * $result['position'];
          }
        }
      }
    }

    return array('charts' =>  $charts, 'data' => $line_chart_data);
  }

  function SongLifeTimePerformance($song_id)
  {
    $ChartNames =
    'SELECT DISTINCT(chart_name) FROM CHARTED NATURAL JOIN CHARTS
    WHERE song_id=?';
    $charts = $this->db->query($ChartNames, array($song_id))->result_array();

    $MinMaxDates =
    'SELECT MIN(date), MAX(date) FROM CHARTED NATURAL JOIN CHARTS
    WHERE song_id=?';
    $MinMaxDates = $this->db->query($MinMaxDates, array($song_id))->result_array();

    // $AllDates =
    // 'SELECT DISTINCT(date) FROM CHARTED NATURAL JOIN CHARTS where song_id=?';
    // $dates = $this->db->query($AllDates, array($song_id))->result_array();

    $DateRange =
    'SELECT DISTINCT(date) FROM CHARTED WHERE date >= ? and date <= ?';
    $dates = $this->db->query($DateRange, array($MinMaxDates[0]['MIN(date)'], $MinMaxDates[0]['MAX(date)']))->result_array();

    $LifeTimePerformance =
    "SELECT date, position, chart_name
    FROM CHARTED NATURAL JOIN CHARTS
    WHERE song_id=? order by date";
    $results = $this->db->query($LifeTimePerformance, array($song_id));
    $results = $results->result_array();

    $line_chart_data = array();

    foreach ($dates as $date)
    {
      $line_chart_data[$date['date']] = array();
      foreach ($charts as $chart)
      {
        $line_chart_data[$date['date']][$chart['chart_name']] =  "";
      }
    }

    foreach ($dates as $date)
    {
      foreach ($charts as $chart)
      {
        foreach ($results as $result)
        {
          if($result['date'] == $date['date'] && $result['chart_name'] == $chart['chart_name'])
          {
              $line_chart_data[$date['date']][$chart['chart_name']] = -1 * $result['position'];
          }
        }
      }
    }

    return array('charts' =>  $charts, 'data' => $line_chart_data);
  }
}
