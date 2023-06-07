<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekeningHadiahController extends CI_Controller
{

    public function __construct()

    {

        parent::__construct();

        $this->load->library('template');
        $this->load->model('RekeningModel', 'Rekening');
        $this->load->model('RekeningHadiahModel', 'RekeningHadiah');
        cek_session();
    }

    public function index()
    {

        $data = [
            'title' => 'Rekening Hadiah',
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'rekening hadiah'
            ],
            'breadcumb' => [
                'title' => 'Rekening Hadiah',
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item active">Rekening Hadiah</li>',
                ]
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/RekeningHadiah/index.js'),
            ],
            'dataRekening' => $this->RekeningHadiah->getDataRekeningHadiah(),
        ];

        $this->template->loadViews('backend/pages/master/rekening-hadiah/index', $data);
    }

    public function form()
    {
        $idRekening = $this->input->get('id');

        $dataRekeningHadiah = isset($idRekening) ? $this->RekeningHadiah->getDataRekeningById($idRekening) : "";

        $mode = $this->input->get('mode');

        $linkAnchirBreadcumb = $mode == 'add' ? 'Tambah' : ($mode == 'edit' ? 'Edit' : 'View');

        $data = [
            'title' => $mode == 'add' ? 'Tambah Rekening Hadiah' : ($mode == 'edit' ? 'Edit Rekening Hadiah' : 'View Rekening Hadiah'),
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'rekening hadiah'
            ],
            'breadcumb' => [
                'title' => $mode == 'add' ? 'Tambah Rekening Hadiah' : ($mode == 'edit' ? 'Edit Rekening Hadiah' : 'View Rekening Hadiah'),
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item">Rekening Hadiah</li>',
                    '<li class="breadcrumb-item active">' . $linkAnchirBreadcumb . '</li>',
                ]
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/RekeningHadiah/index.js'),
            ],
            'mode' => $mode,
            'anchor' => $linkAnchirBreadcumb,
            'dataRekening' => $this->Rekening->getDataRekening(),
            'dataRekeningHadiah' => $dataRekeningHadiah,
            'disable' => $mode == 'view' ? 'disabled' : '',
        ];

        $this->template->loadViews('backend/pages/master/rekening-hadiah/form', $data);
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

        insert_table('rekening_hadiah', [
            'id_rekening' => $dataPost->rekeningId,
            'atas_nama' => $dataPost->atasNama,
            'nomor_rekening' => $dataPost->nomorRekening,
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

    private function editRequest($dataPost)
    {
        $this->db->trans_begin();

        update_table('rekening_hadiah', [
            'id_rekening' => $dataPost->rekeningId,
            'atas_nama' => $dataPost->atasNama,
            'nomor_rekening' => $dataPost->nomorRekening,
        ], ['id' => $dataPost->rekeningHadiahId]);

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

    public function destroy()
    {
        header('Content-Type: application/json');
        $dataPost = json_decode(file_get_contents("php://input"));
        $response = $this->db->delete('rekening_hadiah', ['id' => $dataPost->id]);
        if ($response) {
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
