<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }
  public function index()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = "My Profile";
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top_bar', $data);
    $this->load->view('user/index', $data);
    $this->load->view('templates/footer');
  }
  public function editProfile()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = "Edit Profile";

    $this->form_validation->set_rules('name', 'Fullname', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top_bar', $data);
      $this->load->view('user/edit', $data);
      $this->load->view('templates/footer');
    } else {
      $name = $this->input->post('name');
      $email = $this->input->post('email');

      // cek jika klo ada gambar yang di upload
      $upload_image = $_FILES['image']['name'];

      if ($upload_image) {
        $config['upload_path'] = './assets/img/profile';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']     = '2048';
        $this->load->library('upload', $config);

        // jika ada gambar yang d upload dari name yang bernama image
        if ($this->upload->do_upload('image')) {
          // ini untuk mengambil gambar lama
          $old_image =  $data['user']['image'];
          if ($old_image != 'default.jpg') {
            // unlink untuk menghapus
            // fc path untuk mengetahui filename
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
          }

          // nama gambar baru itu diambil dari script yang dibawah, ketika file yang kita upload telah berhasil
          $new_image = $this->upload->data('file_name');
          $this->db->set('image', $new_image);
        } else {
          echo $this->upload->display_errors();
        }
      }

      $this->db->set('name', $name);
      $this->db->where('email', $email);
      $this->db->update('user');
      $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
      You profile has been updated!
     </div>');
      redirect('user');
    }
  }
  public function changepassword()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = "Change Password";


    $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
    $this->form_validation->set_rules('new_password_1', 'New Password', 'required|trim|min_length[3]|matches[new_password_2]');
    $this->form_validation->set_rules('new_password_2', 'Confirm New Password ', 'required|trim|min_length[3]|matches[new_password_1]');
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top_bar', $data);
      $this->load->view('user/change_password', $data);
      $this->load->view('templates/footer');
    } else {
      $currentPassword = $this->input->post('current_password');
      if (!password_verify($currentPassword, $data['user']['password'])) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
              Your Current Password is wrong!
            </div>');
        redirect('user/changepassword');
      } else {
        $new_password_1 = $this->input->post('new_password_1');
        if ($currentPassword == $new_password_1) {
          $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
          Your Current Password and new password doesnt same!
        </div>');
          redirect('user/changepassword');
        } else {
          $passwordHash = password_hash($new_password_1, PASSWORD_DEFAULT);

          $this->db->set('password', $passwordHash);
          $this->db->where('email', $this->session->userdata('email'));
          $this->db->update('user');
          $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
          Your password has been changed!
        </div>');
          redirect('user');
        }
      }
    }
  }
}
