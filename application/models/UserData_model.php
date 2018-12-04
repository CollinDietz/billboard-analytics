<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserData_model extends CI_Model {
  function GetFavorites($username)
  {
    $favs = array();
    $fav_artists =
    'SELECT artist_name
    FROM USER_FAVORITE_ARTISTS
    JOIN ARTISTS on USER_FAVORITE_ARTISTS.artist_id = ARTISTS.artist_id
    WHERE username = ?';
    $results = $this->db->query($fav_artists, array($username));
    $favs["artists"] = $results->result_array();

    $fav_albums =
    'SELECT album_name, artist_name
    FROM USER_FAVORITE_ALBUMS
    JOIN ALBUMS on USER_FAVORITE_ALBUMS.album_id = ALBUMS.album_id
    JOIN ARTISTS on ALBUMS.artist_id = ARTISTS.artist_id
    WHERE username = ?';
    $results = $this->db->query($fav_albums, array($username));
    $favs["albums"] = $results->result_array();


    $fav_songs =
    'SELECT song_name, artist_name
    FROM USER_FAVORITE_SONGS
    JOIN SONGS on USER_FAVORITE_SONGS.song_id = SONGS.song_id
    JOIN ARTISTS on SONGS.artist_id = ARTISTS.artist_id
    WHERE username = ?';
    $results = $this->db->query($fav_songs, array($username));
    $favs["songs"] = $results->result_array();
    return $favs;
  }

  function IsArtistAUserFavorite($username, $artist_id)
  {
    $query =
    'SELECT ARTISTS.artist_id
    FROM USER_FAVORITE_ARTISTS
    JOIN ARTISTS on USER_FAVORITE_ARTISTS.artist_id = ARTISTS.artist_id
    WHERE username = ? AND ARTISTS.artist_id = ?';
    $results = $this->db->query($query, array($username, $artist_id));

    return count($results->result_array()) > 0;
  }

  function FavoriteArtist($username, $artist_id)
  {
    $query = 'INSERT INTO USER_FAVORITE_ARTISTS (username, artist_id) VALUES (?,?)';
    $this->db->query($query, array($username, $artist_id));
  }

  function UnfavoriteArtist($username, $artist_id)
  {
    $query = 'DELETE FROM USER_FAVORITE_ARTISTS WHERE username = ? AND artist_id = ?';
    $this->db->query($query, array($username, $artist_id));
  }


  function IsSongAUserFavorite($username, $song_id)
  {
    $query =
    'SELECT SONGS.song_id
    FROM USER_FAVORITE_SONGS
    JOIN SONGS on USER_FAVORITE_SONGS.song_id = SONGS.song_id
    WHERE username = ? AND SONGS.song_id = ?';
    $results = $this->db->query($query, array($username, $song_id));

    return count($results->result_array()) > 0;
  }

  function FavoriteSong($username, $song_id)
  {
    $query = 'INSERT INTO USER_FAVORITE_SONGS (username, song_id) VALUES (?,?)';
    $this->db->query($query, array($username, $song_id));
  }

  function UnfavoriteSong($username, $song_id)
  {
    $query = 'DELETE FROM USER_FAVORITE_SONGS WHERE username = ? AND song_id = ?';
    $this->db->query($query, array($username, $song_id));
  }

  function IsAlbumAUserFavorite($username, $album_id)
  {
    $query =
    'SELECT ALBUMS.album_id
    FROM USER_FAVORITE_ALBUMS
    JOIN ALBUMS on USER_FAVORITE_ALBUMS.album_id = ALBUMS.album_id
    WHERE username = ? AND ALBUMS.album_id = ?';
    $results = $this->db->query($query, array($username, $album_id));

    return count($results->result_array()) > 0;
  }

  function FavoriteAlbum($username, $album_id)
  {
    $query = 'INSERT INTO USER_FAVORITE_ALBUMS (username, album_id) VALUES (?,?)';
    $this->db->query($query, array($username, $album_id));
  }

  function UnfavoriteAlbum($username, $album_id)
  {
    $query = 'DELETE FROM USER_FAVORITE_ALBUMS WHERE username = ? AND album_id = ?';
    $this->db->query($query, array($username, $album_id));
  }
}
