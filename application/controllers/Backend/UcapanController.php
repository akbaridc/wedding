<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UcapanController extends CI_Controller
{

    public function __construct()

    {

        parent::__construct();

        $this->load->library('template');
        $this->load->model('TamuUndanganModel', 'TamuUndangan');
        cek_session();
    }

    public function index()
    {

        $data = [
            'title' => 'Ucapan',
            'sidebar' => [
                'parent' => 'Aktifitas',
                'child' => 'ucapan tamu undangan'
            ],
            'breadcumb' => [
                'title' => 'Ucapan',
                'link' => [
                    '<li class="breadcrumb-item">Aktifitas</li>',
                    '<li class="breadcrumb-item active">Ucapan</li>',
                ]
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/Ucapan/index.js')
            ],
            'dataUcapan' => $this->TamuUndangan->getDataTamuUndanganDetail(),
        ];

        $this->template->loadViews('backend/pages/aktifitas/ucapan/index', $data);
    }

	public function updateReply()
	{
		header('Content-Type: application/json');
        $dataPost = json_decode(file_get_contents("php://input"));

		$response = $this->db->update('tamu_undangan_detail', [
			'pesan_balasan' => $dataPost->reply,
			'tanggal_balasan' => date('Y-m-d H:i:s')
		], ['id' => $dataPost->id]);

		if ($response) {
            echo json_encode([
                'status' => true,
                'message' => "Reply Ucapan Sukses",
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => "Reply Ucapan gagal",
            ]);
        }
	}
}
