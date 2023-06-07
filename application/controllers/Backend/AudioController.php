<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AudioController extends CI_Controller
{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('template');
		$this->load->model('AudioModel', 'Audio');
		cek_session();
	}

	public function index()
	{

		$data = [
			'title' => 'Audio',
			'sidebar' => [
				'parent' => 'Setting',
				'child' => 'audio'
			],
			'breadcumb' => [
				'title' => 'Audio',
				'link' => [
					'<li class="breadcrumb-item">Setting</li>',
					'<li class="breadcrumb-item active">Audio</li>',
				]
			],
			'js' => [
				base_url('assets/backend/js/pagesController/Audio/index.js'),
			],
			'dataAudio' => $this->Audio->getDataAudio(),
		];

		$this->template->loadViews('backend/pages/setting/audio/index', $data);
	}

	public function store()
	{
		$dataPost = (object) $this->input->post();
		$this->upload($dataPost);
	}

	private function upload($dataPost)
	{
		$uploadDirectory = "assets/backend/audio/";
		$fileExtensionsAllowed = ['mp3'];
		$fileName = $_FILES['files']['name'];
		$fileTmpName = $_FILES['files']['tmp_name'];
		$files = explode(".", $fileName);
		$name_file = 'Audio-' . time() . strRand(0, 7) . '.' . strtolower(end($files));

		if (!in_array(strtolower(end($files)), $fileExtensionsAllowed)) {
			echo json_encode(['status' => false, 'message' => 'Upload Audio failed! Incompatible extension']);
		} else {
			$uploadPath = $uploadDirectory . $name_file;
			$didUpload = move_uploaded_file($fileTmpName, $uploadPath);
			if (!$didUpload) {
				echo json_encode(['status' => false, 'message' => 'Upload Audio failed! An error occurred on the server']);
			} else {
				$this->db->trans_begin();

				$chkData = $this->Audio->getDataAudio();
				if ($chkData) {
					unlink($uploadDirectory . $chkData[0]->source);
					$this->db->delete('audio', ['id' => $chkData[0]->id]);
				}

				insert_table('audio', [
					'source' => $name_file,
					'created_at' => date('Y-m-d H:i:s')
				]);

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					unlink($uploadDirectory . $name_file);
					echo json_encode([
						'status' => false,
						'message' => "failed save data, please try again",
					]);
				} else {
					$this->db->trans_commit();
					echo json_encode([
						'status' => true,
						'message' => "save data successfuly",
					]);
				}
			}
		}
	}
}
