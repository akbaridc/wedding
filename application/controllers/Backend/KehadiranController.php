<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KehadiranController extends CI_Controller
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
            'title' => 'Kehadiran',
            'sidebar' => [
                'parent' => 'Aktifitas',
                'child' => 'kehadiran tamu undangan'
            ],
            'breadcumb' => [
                'title' => 'Kehadiran',
                'link' => [
                    '<li class="breadcrumb-item">Aktifitas</li>',
                    '<li class="breadcrumb-item active">Kehadiran</li>',
                ]
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/Kehadiran/index.js')
            ],
            'dataKehadiran' => $this->TamuUndangan->getDataTamuUndanganDetail(),
        ];

        $this->template->loadViews('backend/pages/aktifitas/kehadiran/index', $data);
    }
}
