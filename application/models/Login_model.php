<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
{
  function CheckPasswordForUserName($username, $passwordToCheck)
  {
    $local_db = $this->load->database('accounts', TRUE);
    $results = $local_db->query("SELECT Password FROM Accounts WHERE Username=?", array($username));

    if(sizeof($results->result_array()) == 0)
    {
      return FALSE;
    }
    else
    {
      $password = $results->result_array()[0]["Password"];
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
    $local_db = $this->load->database('accounts', TRUE);
    $results = $local_db->query("SELECT count(Username) FROM Accounts WHERE Username=?", array($username));
    return $results->result_array()[0]['count(Username)'] > 0;
  }

  function InsertUser($username, $password)
  {
    if(!$this->CheckForUser($username) && $password !=  '' && strlen($username) <= 10 && strlen($password) <= 10)
    {
      $local_db = $this->load->database('accounts', TRUE);
      $local_db->query(
        "INSERT INTO Accounts (Username, Password) VALUES (?,?)",
       array($username, $password));
       return TRUE;
    }
    else
    {
      return FALSE;
    }
  }
}
