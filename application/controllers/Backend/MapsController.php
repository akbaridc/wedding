<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MapsController extends CI_Controller
{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('template');
		$this->load->model('MapsModel', 'Maps');
		cek_session();
	}

	public function index()
	{

		$data = [
			'title' => 'Maps',
			'sidebar' => [
				'parent' => 'Setting',
				'child' => 'maps'
			],
			'breadcumb' => [
				'title' => 'Maps',
				'link' => [
					'<li class="breadcrumb-item">Setting</li>',
					'<li class="breadcrumb-item active">Maps</li>',
				]
			],
			'js' => [
				base_url('assets/backend/js/pagesController/Maps/index.js')
			],
			'dataMaps' => $this->Maps->getDataMaps()
		];

		$this->template->loadViews('backend/pages/setting/maps/index', $data);
	}

	public function store()
	{
		header('Content-Type: application/json');
		$dataPost = json_decode(file_get_contents("php://input"));
		$this->db->trans_begin();

		$chkData = $this->Maps->getDataMaps();
		if ($chkData) $this->db->delete('maps', ['id' => $chkData->id]);

		insert_table('maps', [
			'alamat' => $dataPost->linkMaps,
			'created_at' => date('Y-m-d H:i:s')
		]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
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
