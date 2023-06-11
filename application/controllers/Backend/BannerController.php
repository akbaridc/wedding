<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BannerController extends CI_Controller
{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('template');
		$this->load->model('BannerModel', 'Banner');
		cek_session();
	}

	public function index()
	{

		$data = [
			'title' => 'Banner',
			'sidebar' => [
				'parent' => 'Master',
				'child' => 'banner'
			],
			'breadcumb' => [
				'title' => 'Banner',
				'link' => [
					'<li class="breadcrumb-item">Master</li>',
					'<li class="breadcrumb-item active">Banner</li>',
				]
			],
			'css' => [
				base_url('assets/frontend/node_modules/lightbox2/dist/css/lightbox.css'),
			],
			'js' => [
				base_url('assets/backend/js/pagesController/Banner/index.js'),
				base_url('assets/frontend/node_modules/lightbox2/dist/js/lightbox.js')
			],
			'bannerUtama' =>  $this->Banner->getDataBanner('primary'),
			'bannerSecond' => $this->Banner->getDataBanner('second'),
		];

		$this->template->loadViews('backend/pages/master/banner/index', $data);
	}

	public function store()
	{
		// $dataPost = file_get_contents("php://input");
		$dataPost = (object) $this->input->post();
		$this->upload($dataPost);
	}

	private function upload($dataPost)
	{
		$uploadDirectory = "assets/backend/img/banner/";
		$fileExtensionsAllowed = ['jpeg', 'jpg', 'png', 'gif', 'JPG', 'JPEG', 'GIF'];
		$fileName = $_FILES['files']['name'];
		$fileTmpName = $_FILES['files']['tmp_name'];
		$files = explode(".", $fileName);
		$name_file = 'Banner-' . time() . strRand(0, 7) . '.' . strtolower(end($files));

		if (!in_array(strtolower(end($files)), $fileExtensionsAllowed)) {
			echo json_encode(['status' => false, 'message' => 'Upload image failed! Incompatible extension']);
		} else {
			$uploadPath = $uploadDirectory . $name_file;

			$didUpload = compressImage($fileTmpName, $uploadPath, 20);
			if (!$didUpload) {
				echo json_encode(['status' => false, 'message' => 'Upload image failed! An error occurred on the server']);
			} else {
				$this->db->trans_begin();

				$chkData = $this->Banner->getDataBanner($dataPost->position == 'bannerPrimary' ? 'primary' : 'second');
				if ($chkData) {
					unlink($uploadDirectory . $chkData->foto);
					$this->db->delete('banner', ['id' => $chkData->id]);
				}

				insert_table('banner', [
					'foto' => $name_file,
					'position' => $dataPost->position == 'bannerPrimary' ? 1 : 2,
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
