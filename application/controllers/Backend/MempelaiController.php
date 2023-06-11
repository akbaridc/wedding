<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MempelaiController extends CI_Controller
{

    public function __construct()

    {

        parent::__construct();

        $this->load->library('template');
        $this->load->model('MempelaiModel', 'Mempelai');
        cek_session();
    }

    public function index()
    {

        $data = [
            'title' => 'Mempelai',
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'mempelai'
            ],
            'breadcumb' => [
                'title' => 'Mempelai',
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item active">Mempelai</li>',
                ]
            ],
            'css' => [
                base_url('assets/frontend/node_modules/lightbox2/dist/css/lightbox.css'),
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/Mempelai/index.js'),
                base_url('assets/frontend/node_modules/lightbox2/dist/js/lightbox.js')
            ],
            'dataMempelai' => $this->Mempelai->getDataMempelai(),
            'countMempelai' => count_table('mempelai')
        ];

        $this->template->loadViews('backend/pages/master/mempelai/index', $data);
    }

    public function form()
    {
        $idMempelai = $this->input->get('id');

        $dataMempelai = isset($idMempelai) ? $this->Mempelai->getDataMempelaiById($idMempelai) : "";
        $dataSosialMediaMempelai = isset($idMempelai) ? $this->Mempelai->getDataSosialMediaByMempelai($idMempelai) : "";

        $dataGenderInDb = $this->db->select('is_gender')->from('mempelai')->get()->result();
        $genderInDb = [];
        if (!empty($dataGenderInDb)) {
            foreach ($dataGenderInDb as $key => $value) {
                $genderInDb[] = $value->is_gender;
            }
        }
        $mode = $this->input->get('mode');

        $linkAnchirBreadcumb = $mode == 'add' ? 'Tambah' : ($mode == 'edit' ? 'Edit' : 'View');

        $data = [
            'title' => $mode == 'add' ? 'Tambah Mempelai' : ($mode == 'edit' ? 'Edit Mempelai' : 'View Mempelai'),
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'mempelai'
            ],
            'breadcumb' => [
                'title' => $mode == 'add' ? 'Tambah Mempelai' : ($mode == 'edit' ? 'Edit Mempelai' : 'View Mempelai'),
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item">Mempelai</li>',
                    '<li class="breadcrumb-item active">' . $linkAnchirBreadcumb . '</li>',
                ]
            ],
            'css' => [
                base_url('assets/frontend/node_modules/lightbox2/dist/css/lightbox.css'),
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/Mempelai/index.js'),
                base_url('assets/frontend/node_modules/lightbox2/dist/js/lightbox.js')
            ],
            'mode' => $mode,
            'anchor' => $linkAnchirBreadcumb,
            'dataMempelai' => $dataMempelai,
            'dataSosialMediaMempelai' => $dataSosialMediaMempelai,
            'disable' => $mode == 'view' ? 'disabled' : '',
            'genderInDb' => $genderInDb,
            'optionGender' => [
                '1' => 'Pria',
                '2' => 'Wanita'
            ]
        ];

        $this->template->loadViews('backend/pages/master/mempelai/form', $data);
    }

    public function store()
    {
        $dataPost = (object) $this->input->post();
        $this->upload($dataPost);
    }

    private function upload($dataPost)
    {
        if (!empty($_FILES)) {
            $uploadDirectory = "assets/backend/img/foto_mempelai/";
            $fileExtensionsAllowed = ['jpeg', 'jpg', 'png', 'gif', 'JPG', 'JPEG', 'GIF'];
            $fileName = $_FILES['files']['name'];
            $fileTmpName = $_FILES['files']['tmp_name'];
            $files = explode(".", $fileName);
            $name_file = 'Image-' . time() . strRand(0, 7) . '.' . strtolower(end($files));

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
        // $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        $didUpload = compressImage($fileTmpName, $uploadPath, 20);
        if (!$didUpload) {
            echo json_encode(['status' => false, 'message' => 'Upload image failed! An error occurred on the server']);
        } else {
            $this->db->trans_begin();

            insert_table('mempelai', [
                'nama_panggilan' => $dataPost->namaPanggilan,
                'nama_lengkap' => $dataPost->namaLengkap,
                'alamat' => $dataPost->alamat,
                'foto' => $name_file,
                'orang_tua' => $dataPost->namaOrangTua,
                'is_gender' => (int)$dataPost->gender,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $lastId = $this->db->insert_id();

            if (!empty($dataPost->sosialMedia)) {
                foreach ($dataPost->sosialMedia as $value) {
                    $sosialMedia = explode('|', $value);
                    insert_table('mempelai_detail', [
                        'id_mempelai' => $lastId,
                        'nama' => $sosialMedia[0],
                        'link' => $sosialMedia[1],
                        'icon' => $sosialMedia[2],
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                unlink('assets/backend/img/foto_mempelai/' . $name_file);
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

        $oldFoto = $this->Mempelai->getOldFotoMempelaiById($dataPost->mempelaiId);

        $dataUpdate = [
            'nama_panggilan' => $dataPost->namaPanggilan,
            'nama_lengkap' => $dataPost->namaLengkap,
            'alamat' => $dataPost->alamat,
            'orang_tua' => $dataPost->namaOrangTua
        ];

        if ($name_file != null) {
            compressImage($fileTmpName, $uploadPath, 20);
            // move_uploaded_file($fileTmpName, $uploadPath);
            $dataUpdate['foto'] = $name_file;
        }

        update_table('mempelai', $dataUpdate, ['id' => $dataPost->mempelaiId]);

        $this->db->delete('mempelai_detail', ['id_mempelai' => $dataPost->mempelaiId]);

        if (!empty($dataPost->sosialMedia)) {
            foreach ($dataPost->sosialMedia as $value) {
                $sosialMedia = explode('|', $value);
                insert_table('mempelai_detail', [
                    'id_mempelai' => $dataPost->mempelaiId,
                    'nama' => $sosialMedia[0],
                    'link' => $sosialMedia[1],
                    'icon' => $sosialMedia[2],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            if ($name_file != null) unlink('assets/backend/img/foto_mempelai/' . $name_file);
            echo json_encode([
                'status' => false,
                'message' => "failed edit data, please try again",
            ]);
        } else {
            $this->db->trans_commit();
            if ($name_file != null) {
                unlink('assets/backend/img/foto_mempelai/' . $oldFoto);
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
        $response = $this->db->delete('mempelai', ['id' => $dataPost->id]);
        if ($response) {
            unlink('assets/backend/img/foto_mempelai/' . $dataPost->foto);
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
