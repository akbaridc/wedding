<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
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
            'title' => 'Dasboard',
            'sidebar' => [
                'parent' => 'Dashboard'
            ],
            'breadcumb' => [
                'title' => 'Dasboard',
                'link' => [
                    '<li class="breadcrumb-item active">Dashboard</li>',
                ]
            ],
            'js' => [
                base_url('assets/backend/js/pagesController/Dashboard/index.js'),
            ],
        ];

        $this->template->loadViews('backend/pages/dashboard/index', $data);
    }

    public function getCountTamuKehadiran()
    {
        echo json_encode($this->TamuUndangan->getCountTamuKehadiran());
    }
}
