<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function index()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = "Dashboard";
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top_bar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer');
  }
  public function role()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = "Role";
    $data['role'] = $this->db->get('user_role')->result_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top_bar', $data);
    $this->load->view('admin/role', $data);
    $this->load->view('templates/footer');
  }
  public function roleAccess($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = "Role Access";
    $data['role'] = $this->db->get_where('user_role', ['id' => $id])->row_array();


    $this->db->where('id !=', 1);
    $data['menu'] = $this->db->get('user_menu')->result_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top_bar', $data);
    $this->load->view('admin/role_Access', $data);
    $this->load->view('templates/footer');
  }
  public function changeAccess()
  {
    $menu_id = $this->input->post('menuId');
    $role_id = $this->input->post('roleId');

    $data = [
      'role_id' => $role_id,
      'menu_id' => $menu_id
    ];
    $resultAccess = $this->db->get_where('user_access_menu', $data);
    if ($resultAccess->num_rows() < 1) {
      $this->db->insert('user_access_menu', $data);
    } else {
      $this->db->delete('user_access_menu', $data);
    }
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Your Account has been changed!</div>');
  }
}
