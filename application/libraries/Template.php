<?php

class Template
{
    protected $_ci;
    function __construct()

    {
        $this->_ci = &get_instance();
    }

    function loadViews($content, $data = NULL)

    {

        $data['header'] = $this->_ci->load->view('backend/layout/header', $data, TRUE);

        $data['navbar'] = $this->_ci->load->view('backend/layout/navbar', $data, TRUE);

        $data['sidebar'] = $this->_ci->load->view('backend/layout/sidebar', $data, TRUE);

        $data['breadcumb'] = $this->_ci->load->view('backend/layout/breadcumb', $data, TRUE);

        $data['content'] = $this->_ci->load->view($content, $data, TRUE);

        $data['footer'] = $this->_ci->load->view('backend/layout/footer', $data, TRUE);

        $data['js'] = $this->_ci->load->view('backend/layout/js', $data, TRUE);


        $this->_ci->load->view('backend/layout/app', $data);
    }
}
