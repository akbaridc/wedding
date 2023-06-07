<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class RekeningModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function getDataRekening()
    {
        return $this->db->select("*")->from('rekening')->order_by('id')->get()->result();
    }

    public function getDataRekeningById($id)
    {
        return $this->db->select("*")->from('rekening')->where('id', $id)->get()->row();
    }

    public function getOldFotoRekeningById($id)
    {
        return $this->db->select("logo")->from('rekening')->where('id', $id)->get()->row()->logo;
    }

    public function getDataRekeningByGender($gender)
    {
        return $this->db->select("*")->from('rekening')->where('is_gender', $gender)->get()->row();
    }
}
