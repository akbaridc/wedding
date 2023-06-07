<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GaleryController extends CI_Controller
{

    public function __construct()

    {

        parent::__construct();

        $this->load->library('template');
        $this->load->model('GaleryModel', 'Galery');
        cek_session();
    }

    public function index()
    {

        $data = [
            'title' => 'Galery',
            'sidebar' => [
                'parent' => 'Master',
                'child' => 'galery'
            ],
            'breadcumb' => [
                'title' => 'Galery',
                'link' => [
                    '<li class="breadcrumb-item">Master</li>',
                    '<li class="breadcrumb-item active">Galery</li>',
                ]
            ],
            'css' => [
                base_url('assets/frontend/node_modules/lightbox2/dist/css/lightbox.css'),
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/Galery/index.js'),
                base_url('assets/frontend/node_modules/lightbox2/dist/js/lightbox.js')
            ],
            'dataGalery' => $this->Galery->getDataGalery(),
        ];

        $this->template->loadViews('backend/pages/master/galery/index', $data);
    }

    public function store()
    {
        $dataPost = (object) $this->input->post();
        $this->upload($dataPost);
    }

    private function upload($dataPost)
    {
        $uploadDirectory = "assets/backend/img/galery/";
        $fileExtensionsAllowed = ['jpeg', 'jpg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF']; // Allowed file extensions

        $errors = [];
        $fileNames = [];

        for ($i = 0; $i < count($_FILES['files']['tmp_name']); $i++) {
            $fileName = $_FILES['files']['name'][$i];
            $fileTmpName = $_FILES['files']['tmp_name'][$i];
            $files = explode(".", $fileName);
            $name_file = 'Galery-' . time() . strRand(0, 7) . '.' . strtolower(end($files));
            $fileNames[] = $name_file;

            if (!in_array(strtolower(end($files)), $fileExtensionsAllowed)) {
                $errors[] = 2;
            } else {
                $uploadPath = $uploadDirectory . $name_file;
                $didUpload = compressImage($fileTmpName, $uploadPath, 20);
                // $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                // $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                if (!$didUpload) {
                    $errors[] = 'Data failed to save! An error occurred on the server';
                }
            }
        }

        if (empty($errors)) {
            $this->saveToDb(json_encode($fileNames), $uploadDirectory);
        } else {
            foreach ($errors as $key => $value) {
                if ($value == 2) {
                    unlink($uploadDirectory . $fileNames[$key]);
                }
            }
            echo json_encode(array('status' => false, 'message' => 'Data failed to save! Photo files do not comply with the provisions'));
        }
    }

    private function saveToDb($file, $uploadDirectory)
    {
        $this->db->trans_begin();

        foreach (json_decode($file) as $key => $value) {
            insert_table('galery', [
                'foto' => $value,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            foreach (json_decode($file) as $key => $value) {
                unlink($uploadDirectory . $value);
            }
            echo json_encode([
                'status' => false,
                'message' => "Failed Save data"
            ]);
        } else {
            $this->db->trans_commit();
            echo json_encode([
                'status' => true,
                'message' => "Save data Successfully"
            ]);
        }
    }

    public function destroy()
    {
        header('Content-Type: application/json');
        $dataPost = json_decode(file_get_contents("php://input"));
        $response = $this->db->delete('galery', ['id' => $dataPost->galeryId]);
        if ($response) {
            unlink('assets/backend/img/galery/' . $dataPost->fileFoto);
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
