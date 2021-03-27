<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Europe/Kiev');
class Comment_model extends CI_Model
{
  public $comment_body;
  public $comment_email;
  public $comment_nickname;
  public $comment_date_create;

  public function __construct()
  {
    parent::__construct();
  }

  public function get_current_page_record($limit, $start)
  {
    if($start > 0) {
      $start = $limit * ($start - 1);
    }
    $this->db->limit($limit, $start);
    $this->db->order_by("comment_date_create", "desc");
    $query = $this->db->get("comment");

    if ($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $data[] = $row;
      }

      return $data;
    }

    return false;
  }

  public function add_new_comment()
  {
    $this->comment_body = $_POST['comment_body'];
    $this->comment_email = $_POST['comment_email'];
    $this->comment_nickname = $_POST['comment_nickname'];
    $this->comment_date_create = date('Y-m-d\TH:i:sO');
    $this->db->insert('comment', $this);
  }

  public function get_total()
  {
    return $this->db->count_all('comment');
  }
}
