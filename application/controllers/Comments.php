<?php
class Comments extends CI_Controller{
  public function __construct()
  {
      parent::__construct();

      $this->load->library('pagination');
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->helper('url');
      $this->load->model('comment_model');
  }

  public function index()
  {
    $this->load->view('header');
    $this->load->view('comment');
  }

  public function show($rowno=0)
  {
    $params = array();
    $this->config->load('pagination', TRUE);
    $settings = $this->config->item('pagination');

    $settings['total_rows'] = $this->comment_model->get_total();
    $settings['base_url'] = base_url() . 'comments/show';
    $this->pagination->initialize($settings);

    $params['comments'] = $this->comment_model->get_current_page_record($settings['per_page'], $rowno);
    $params['pagination'] =  $this->pagination->create_links();

    echo json_encode($params);
  }

  public function create()
  {
    $this->form_validation->set_rules('comment_email', 'comment_email', 'required');
    $this->form_validation->set_rules('comment_body', 'comment_body', 'required');


    if ($this->form_validation->run() == FALSE){
        $status = ['Validation error' => 'request not finish'];
        # $this->session->set_flashdata('errors', validation_errors());
        echo json_encode($status);
    }else{
       $status = ['Success' => 'Comment Add'];
       $this->comment_model->add_new_comment();
       echo json_encode($status);
    }
  }

  public static function get_user_name($email, $nick_name)
  {
    if (!$nick_name) {
      return explode('@', $email)[0];
    }
    return $nick_name;
  }


  private function paginate_index_not_found($current_index, $all_page_index){
    if ($current_index > (int)$all_page_index){
      $params['heading'] = 'Страница не найдена';
      $params['message'] = 'Увы но такой страницы нет';
      return $this->load->view('errors/html/error_404', $params);
    }
    return false;
  }
}
