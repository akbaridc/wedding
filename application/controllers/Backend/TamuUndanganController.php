<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TamuUndanganController extends CI_Controller
{

    public function __construct()

    {

        parent::__construct();

        $this->load->library('template');
        $this->load->model('RekeningModel', 'Rekening');
        $this->load->model('TamuUndanganModel', 'TamuUndangan');
        cek_session();
    }

    public function index()
    {

        $data = [
            'title' => 'Tamu Undangan',
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'tamu undangan'
            ],
            'breadcumb' => [
                'title' => 'Tamu Undangan',
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item active">Tamu Undangan</li>',
                ]
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/TamuUndangan/index.js'),
            ],
            'dataTamuUndangan' => $this->TamuUndangan->getDataTamuUndangan(),
        ];

        $this->template->loadViews('backend/pages/master/tamu-undangan/index', $data);
    }

    public function form()
    {
        $data = [
            'title' => 'Tambah Tamu Undangan',
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'tamu undangan'
            ],
            'breadcumb' => [
                'title' => 'Tambah Tamu Undangan',
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item">Tamu Undangan</li>',
                    '<li class="breadcrumb-item active">tambah</li>',
                ]
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/TamuUndangan/index.js'),
            ],
        ];

        $this->template->loadViews('backend/pages/master/tamu-undangan/form', $data);
    }

    public function store()
    {
        header('Content-Type: application/json');
        $dataPost = json_decode(file_get_contents("php://input"));

        if ($dataPost->mode == 'add') $this->addRequest($dataPost);
        if ($dataPost->mode == 'edit') $this->editRequest($dataPost);
    }
    private function addRequest($dataPost)
    {
        $this->db->trans_begin();

        foreach ($dataPost->dataTamuUndangan as $key => $value) {
            insert_table('tamu_undangan', [
                'slug' => createSlug($value->nama),
                'nama' => $value->nama,
                'telepon' => $value->telepon,
                'teman_dari' => $value->temanDari,
                'link' => base_url() . "?kepada=" . createSlug($value->nama),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

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

    private function editRequest($dataPost)
    {
        $this->db->trans_begin();

        update_table('tamu_undangan', [
            'slug' => createSlug($dataPost->nama),
            'nama' => $dataPost->nama,
            'telepon' => $dataPost->telepon,
            'teman_dari' => $dataPost->temanDari,
            'link' => base_url() . "?kepada=" . createSlug($dataPost->nama),
            'created_at' => date('Y-m-d H:i:s')
        ], ['id' => $dataPost->id]);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo json_encode([
                'status' => false,
                'message' => "failed edit data, please try again",
            ]);
        } else {
            $this->db->trans_commit();
            echo json_encode([
                'status' => true,
                'message' => "edit data successfuly",
            ]);
        }
    }

    public function getDataTamuUndanganById()
    {
        header('Content-Type: application/json');
        $dataPost = json_decode(file_get_contents("php://input"));
        echo json_encode(where_row('tamu_undangan', ['id' => $dataPost->id]));
    }

    public function sendMessageWhatsapp()
    {
        $dataPost = (object) $this->input->post();
        $getDataTamuUndangan = $this->TamuUndangan->getDataTamuUndanganByMultiId($dataPost->dataChecked);

        echo json_encode($getDataTamuUndangan);
    }

    public function destroy()
    {
        header('Content-Type: application/json');
        $dataPost = json_decode(file_get_contents("php://input"));
        $response = $this->db->delete('tamu_undangan', ['id' => $dataPost->id]);
        if ($response) {
            $this->db->delete('tamu_undangan_detail', ['id_tamu_undangan' => $dataPost->id]);
            echo json_encode([
                'status' => true,
                'message' => "delete data successfuly",
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => "delete data failed",
            ]);
        }
    }
}
