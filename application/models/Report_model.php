<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report_model extends CI_Model
{
  function SubmitReport($url, $info, $username=NULL)
  {
    $query = 'INSERT INTO REPORTS (url, info, username) VALUES (?,?,?)';
    $this->db->query($query, array($url, $info, $username));
  }
}
