<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserData_model extends CI_Model {
  function GetFavorites($username)
  {
    $query =
    'SELECT artist_name
    FROM USER_FAVORITES
    JOIN ARTISTS on USER_FAVORITES.artist_id = ARTISTS.artist_id
    WHERE username = ?';
    $results = $this->db->query($query, array($username));
    return $results = $results->result_array();
  }

  function IsArtistAUserFavorite($username, $artist_id)
  {
    $query =
    'SELECT ARTISTS.artist_id
    FROM USER_FAVORITES
    JOIN ARTISTS on USER_FAVORITES.artist_id = ARTISTS.artist_id
    WHERE username = ? AND ARTISTS.artist_id = ?';
    $results = $this->db->query($query, array($username, $artist_id));

    return count($results->result_array()) > 0;
  }

  function FavoriteArtist($username, $artist_id)
  {
    $query = 'INSERT INTO USER_FAVORITES (username, artist_id) VALUES (?,?)';
    $this->db->query($query, array($username, $artist_id));
  }

  function UnfavoriteArtist($username, $artist_id)
  {
    $query = 'DELETE FROM USER_FAVORITES WHERE username = ? AND artist_id = ?';
    $this->db->query($query, array($username, $artist_id));
  }
}
