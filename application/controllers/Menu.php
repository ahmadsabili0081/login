<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function index()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = "Menu Management";
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->form_validation->set_rules('menu', 'menu', 'required');
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top_bar', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('templates/footer');
    } else {
      $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
         added new user menu success!
         </div>');
      redirect('menu');
    }
  }
  public function subMenu()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = "subMenu Management";
    $this->load->model('Menu_model', 'menu');
    $data['subMenu'] = $this->menu->getSubMenu();
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('url', 'Url', 'required');
    $this->form_validation->set_rules('icon', 'Icon', 'required');
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top_bar', $data);
      $this->load->view('menu/subMenu', $data);
      $this->load->view('templates/footer');
    } else {
      $data = array(
        'title' => $this->input->post('title'),
        'menu_id' => $this->input->post('menu_id'),
        'url' => $this->input->post('url'),
        'icon' => $this->input->post('icon'),
        'is_active' => $this->input->post('is_active')
      );
      $this->db->insert('user_sub_menu', $data);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
      added new Submenu success!
      </div>');
      redirect('menu/subMenu');
    }
  }
  public function editsubMenu($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Menu_model', 'menu');
    $data['title'] = "Edit SubMenu Page";
    $data['subMenu'] = $this->menu->getMenuById($id);
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top_bar', $data);
    $this->load->view('menu/subMenuEdit', $data);
    $this->load->view('templates/footer');
  }
  public function editMenuSub()
  {
    $this->form_validation->set_rules('title', 'Title Menu', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu Access', 'required');
    $this->form_validation->set_rules('title', 'Url', 'required');
    $this->form_validation->set_rules('title', 'Icon', 'required');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                                      Your subMenu failed to update!
                                    </div>');
      redirect('menu/subMenu');
    } else {
      $data = array(
        'id' => $this->input->post('id'),
        'title' => $this->input->post('title'),
        'menu_id' => $this->input->post('menu_id'),
        'url' => $this->input->post('url'),
        'icon' => $this->input->post('icon'),
        'is_active' => $this->input->post('is_active')
      );
      $this->db->where('id', $data['id']);
      $this->db->update('user_sub_menu', $data);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
                                      Your subMenu already update!
                                    </div>');
      redirect('menu/subMenu');
    }
  }
  public function deletesubMenu($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user_sub_menu');
    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
    Your subMenu has been Delete!
  </div>');
    redirect('menu/subMenu');
  }
}
