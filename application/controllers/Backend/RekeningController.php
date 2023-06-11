<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekeningController extends CI_Controller
{

    public function __construct()

    {

        parent::__construct();

        $this->load->library('template');
        $this->load->model('RekeningModel', 'Rekening');
        cek_session();
    }

    public function index()
    {

        $data = [
            'title' => 'Rekening',
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'rekening'
            ],
            'breadcumb' => [
                'title' => 'Rekening',
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item active">Rekening</li>',
                ]
            ],
            'css' => [
                base_url('assets/frontend/node_modules/lightbox2/dist/css/lightbox.css'),
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/Rekening/index.js'),
                base_url('assets/frontend/node_modules/lightbox2/dist/js/lightbox.js')
            ],
            'dataRekening' => $this->Rekening->getDataRekening(),
        ];

        $this->template->loadViews('backend/pages/master/rekening/index', $data);
    }

    public function form()
    {
        $idRekening = $this->input->get('id');

        $dataRekening = isset($idRekening) ? $this->Rekening->getDataRekeningById($idRekening) : "";

        $mode = $this->input->get('mode');

        $linkAnchirBreadcumb = $mode == 'add' ? 'Tambah' : ($mode == 'edit' ? 'Edit' : 'View');

        $data = [
            'title' => $mode == 'add' ? 'Tambah Rekening' : ($mode == 'edit' ? 'Edit Rekening' : 'View Rekening'),
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'rekening'
            ],
            'breadcumb' => [
                'title' => $mode == 'add' ? 'Tambah Rekening' : ($mode == 'edit' ? 'Edit Rekening' : 'View Rekening'),
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item">Rekening</li>',
                    '<li class="breadcrumb-item active">' . $linkAnchirBreadcumb . '</li>',
                ]
            ],
            'css' => [
                base_url('assets/frontend/node_modules/lightbox2/dist/css/lightbox.css'),
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/Rekening/index.js'),
                base_url('assets/frontend/node_modules/lightbox2/dist/js/lightbox.js')
            ],
            'mode' => $mode,
            'anchor' => $linkAnchirBreadcumb,
            'dataRekening' => $dataRekening,
            'disable' => $mode == 'view' ? 'disabled' : '',
        ];

        $this->template->loadViews('backend/pages/master/rekening/form', $data);
    }

    public function store()
    {
        $dataPost = (object) $this->input->post();
        $this->upload($dataPost);
    }

    private function upload($dataPost)
    {
        if (!empty($_FILES)) {
            $uploadDirectory = "assets/backend/img/rekening/";
            $fileExtensionsAllowed = ['jpeg', 'jpg', 'png', 'gif', 'JPG', 'JPEG', 'GIF'];
            $fileName = $_FILES['files']['name'];
            $fileTmpName = $_FILES['files']['tmp_name'];
            $files = explode(".", $fileName);
            $name_file = 'Rekening-' . time() . strRand(0, 7) . '.' . strtolower(end($files));

            if (!in_array(strtolower(end($files)), $fileExtensionsAllowed)) {
                echo json_encode(['status' => false, 'message' => 'Upload image failed! Incompatible extension']);
            } else {
                $uploadPath = $uploadDirectory . $name_file;
                if ($dataPost->mode == 'add') $this->addRequest($dataPost, $fileTmpName, $uploadPath, $name_file);
                if ($dataPost->mode == 'edit') $this->editRequest($dataPost, $fileTmpName, $uploadPath, $name_file);
            }
        } else {
            if ($dataPost->mode == 'edit') $this->editRequest($dataPost, null, null, null);
        }
    }

    private function addRequest($dataPost, $fileTmpName, $uploadPath, $name_file)
    {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        // $didUpload = compressImage($fileTmpName, $uploadPath, 20);
        if (!$didUpload) {
            echo json_encode(['status' => false, 'message' => 'Upload image failed! An error occurred on the server']);
        } else {
            $this->db->trans_begin();

            insert_table('rekening', [
                'rekening' => $dataPost->rekening,
                'logo' => $name_file,
                'color' => $dataPost->color,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                unlink('assets/backend/img/rekening/' . $name_file);
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

    private function editRequest($dataPost, $fileTmpName, $uploadPath, $name_file)
    {
        $this->db->trans_begin();

        $oldFoto = $this->Rekening->getOldFotoRekeningById($dataPost->rekeningId);

        $dataUpdate = [
            'rekening' => $dataPost->rekening,
            'color' => $dataPost->color,
        ];

        if ($name_file != null) {
            // compressImage($fileTmpName, $uploadPath, 20);
            move_uploaded_file($fileTmpName, $uploadPath);
            $dataUpdate['logo'] = $name_file;
        }

        update_table('rekening', $dataUpdate, ['id' => $dataPost->rekeningId]);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            if ($name_file != null) unlink('assets/backend/img/rekening/' . $name_file);
            echo json_encode([
                'status' => false,
                'message' => "failed edit data, please try again",
            ]);
        } else {
            $this->db->trans_commit();
            if ($name_file != null) {
                unlink('assets/backend/img/rekening/' . $oldFoto);
            }
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
        $response = $this->db->delete('rekening', ['id' => $dataPost->id]);
        if ($response) {
            unlink('assets/backend/img/rekening/' . $dataPost->foto);
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
