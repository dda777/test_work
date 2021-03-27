<?php
$config['per_page'] = 3;
$config["uri_segment"] = 3;

$config['reuse_query_string']   = true;
$config['use_page_numbers']     = true;
$config['first_link'] = false;
$config['last_link'] = false;


$config['attributes'] = array('class' => 'page-link');
$config['full_tag_open'] = '<ul class="pagination justify-content-center">';
$config['full_tag_close'] = '</ul>';




$config['next_link'] = 'Next Page';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = 'Prev Page';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';
