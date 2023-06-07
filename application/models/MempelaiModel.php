<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class MempelaiModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function getDataMempelai()
    {
        return $this->db->select("id, nama_lengkap, foto, alamat, is_gender")->from('mempelai')->order_by('is_gender')->get()->result();
    }

    public function getDataMempelaiById($id)
    {
        return $this->db->select("*")->from('mempelai')->where('id', $id)->get()->row();
    }

    public function getOldFotoMempelaiById($id)
    {
        return $this->db->select("foto")->from('mempelai')->where('id', $id)->get()->row()->foto;
    }

    public function getDataMempelaiByGender($gender)
    {
        return $this->db->select("*")->from('mempelai')->where('is_gender', $gender)->get()->row();
    }

	public function getDataSosialMediaByGender($gender)
	{
		return $this->db->select("mempelai_detail.*")->from('mempelai_detail')
					->join('mempelai', 'mempelai_detail.id_mempelai = mempelai.id', 'left')
					->where('mempelai.is_gender', $gender)->get()->result();
	}

    public function getDataSosialMediaByMempelai($id)
    {
        return $this->db->select("*")->from('mempelai_detail')->where('id_mempelai', $id)->get()->result();
    }
}
