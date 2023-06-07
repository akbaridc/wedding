<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class GaleryModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function getDataGalery()
    {
        return $this->db->select("*")->from("galery")->order_by('id', 'ASC')->get()->result();
    }
}
