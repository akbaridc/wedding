<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcaraController extends CI_Controller
{

    public function __construct()

    {

        parent::__construct();

        $this->load->library('template');
        $this->load->model('AcaraModel', 'Acara');
        $this->load->model('MempelaiModel', 'Mempelai');
        cek_session();
    }

    public function index()
    {

        $data = [
            'title' => 'Acara',
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'acara'
            ],
            'breadcumb' => [
                'title' => 'Acara',
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item active">Acara</li>',
                ]
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/Acara/index.js')
            ],
            'dataMempelai' => $this->Mempelai->getDataMempelai(),
            'dataAcara' => $this->Acara->getDataAcara(),
            'countAcara' => count_table('acara')
        ];

        $this->template->loadViews('backend/pages/master/acara/index', $data);
    }

    public function form()
    {
        $mode = $this->input->get('mode');
        $type = $this->input->get('type') !== null ? $this->input->get('type') : "";

        $dataAcaraAkad = $mode !== 'add' ? $this->Acara->getDataAcaraByType('Akad Nikah') : "";
        $dataAcaraResepsi = $mode !== 'add' ? $this->Acara->getDataAcaraByType('Resepsi') : "";

        $linkAnchirBreadcumb = $mode == 'add' ? 'Tambah' : ($mode == 'edit' ? 'Edit' : 'View');

        $data = [
            'title' => $mode == 'add' ? 'Tambah Acara' : ($mode == 'edit' ? 'Edit Acara' : 'View Acara'),
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'acara'
            ],
            'breadcumb' => [
                'title' => $mode == 'add' ? 'Tambah Acara' : ($mode == 'edit' ? 'Edit Acara' : 'View Acara'),
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item">Acara</li>',
                    '<li class="breadcrumb-item active">' . $linkAnchirBreadcumb . '</li>',
                ]
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/Acara/index.js')
            ],
            'mode' => $mode,
            'typeUrl' => $type,
            'anchor' => $linkAnchirBreadcumb,
            'dataMempelai' => $this->Mempelai->getDataMempelai(),
            'dataAcaraAkad' => $dataAcaraAkad,
            'dataAcaraResepsi' => $dataAcaraResepsi,
            'disable' => $mode == 'view' ? 'disabled' : '',
        ];


        $this->template->loadViews('backend/pages/master/acara/form', $data);
    }

    public function store()
    {
        header('Content-Type: application/json');
        $dataPost = json_decode(file_get_contents("php://input"));
        $this->requestSaveOrUpdateData($dataPost);
    }

    private function requestSaveOrUpdateData($dataPost)
    {
        $this->db->trans_begin();

        if ($dataPost->mode == 'edit') $this->db->empty_table('acara');

        foreach ($dataPost->dataAcaraPost as $key => $value) {
            $dataInsert = [
                'tanggal' => $value->tanggalAcara,
                'waktu_mulai' => $value->waktuMulaiAcara,
                'type' => $value->type == 'akad' ? 1 : 2,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            if ($value->tempatAcara !== "other") $dataInsert['id_mempelai'] = $value->tempatAcara;
            if ($value->isFinishedAcara === false) $dataInsert['waktu_selesai'] = $value->waktuSelesaiAcara;
            if ($value->isFinishedAcara === true) $dataInsert['is_finished'] = 1;
            if ($value->tempatAcara === "other") {
                $dataInsert['is_other_place'] = 1;
                $dataInsert['tempat_other'] = $value->tempatOtherAcara;
                $dataInsert['alamat_other'] = $value->alamatOtherAcara;
            };

            insert_table('acara', $dataInsert);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            echo json_encode([
                'status' => false,
                'message' => $this->db->_error_message(),
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
