<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
{
  function CheckPasswordForUserName($username, $passwordToCheck)
  {
    $results = $this->db->query("SELECT password FROM ACCOUNTS WHERE username=?", array($username));

    if(sizeof($results->result_array()) == 0)
    {
      return FALSE;
    }
    else
    {
      $password = $results->result_array()[0]["password"];
      if($password != $passwordToCheck)
      {
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }
  }

  function CheckForUser($username)
  {
    $results = $this->db->query("SELECT count(username) FROM ACCOUNTS WHERE username=?", array($username));
    return $results->result_array()[0]['count(username)'] > 0;
  }

  function InsertUser($username, $password)
  {
    if(!$this->CheckForUser($username) && $password !=  '' && strlen($username) <= 20 && strlen($password) <= 20)
    {
      $this->db->query(
        "INSERT INTO ACCOUNTS (username, password) VALUES (?,?)",
       array($username, $password));
       return TRUE;
    }
    else
    {
      return FALSE;
    }
  }
}
