<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class RekeningHadiahModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function getDataRekeningHadiah()
    {
        return $this->db->select("a.*, b.rekening, b.logo, b.color")
            ->from('rekening_hadiah a')
            ->join('rekening b', 'a.id_rekening = b.id', 'left')
            ->order_by('a.id')->get()->result();
    }

    public function getDataRekeningById($id)
    {
        return $this->db->select("*")->from('rekening_hadiah')->where('id', $id)->get()->row();
    }
}
