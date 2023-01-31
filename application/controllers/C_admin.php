<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function dashboard()
	{
		$this->load->view('inc/header');
		$this->load->view('inc/navbar');
		$this->load->view('inc/sidebar');
		$this->load->view('main/dashboard');
		$this->load->view('inc/footer');
	}

	public function manajemen_pengguna()
	{
		$sql = "SELECT * FROM user";
		$data["user"] = $this->db->query($sql)->result_array();

		$this->load->view('inc/header');
		$this->load->view('inc/navbar');
		$this->load->view('inc/sidebar');
		$this->load->view('main/manajemen_pengguna', $data);
		$this->load->view('inc/footer');
	}

	public function tambah_pengguna()
	{
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$pass = $this->input->post('password');

		$sql = "INSERT INTO user(name, pass, email, status) VALUES(?, ?, ?, ?)";
		$bind = array($name, $pass, $email, 'nonaktif');
		$data = $this->db->query($sql, $bind);
		if ($data) {
			redirect("manajemen_pengguna");
		} else {
			echo ("error");
		}
	}

	public function spesifik_pengguna()
	{
		$id = $this->input->post('id');

		$sql = "SELECT * FROM user WHERE id=?";
		$bind = array($id);
		$data = $this->db->query($sql, $bind)->result_array();

		echo json_encode($data);
	}

	public function ubah_pengguna()
	{
		$id = $this->input->post('id');
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$pass = $this->input->post('password');
		$status = $this->input->post('status');

		$sql = "UPDATE user SET email = ?, name = ?, pass = ?, status = ? WHERE id = ?";
		$bind = array($email, $name, $pass, $status, $id);
		$data = $this->db->query($sql, $bind);
		if ($data) {
			redirect("manajemen_pengguna");
		} else {
			echo ("error");
		}
	}

	public function hapus_pengguna()
	{
		$id = $this->input->post('id');

		$sql = "DELETE FROM user WHERE id = ?";
		$bind = array($id);
		$data = $this->db->query($sql, $bind);
		echo $data;
	}
}
