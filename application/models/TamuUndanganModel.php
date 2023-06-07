<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class TamuUndanganModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function getDataTamuUndangan()
    {
        return $this->db->select("*")->from('tamu_undangan')->order_by('id')->get()->result();
    }

    public function getDataTamuUndanganById($id)
    {
        return $this->db->select("*")->from('tamu_undangan')->where('id', $id)->get()->row();
    }

    public function getDataTamuUndanganByMultiId($id)
    {
        return $this->db->select("nama, link, telepon")->from('tamu_undangan')->where_in('id', $id)->get()->result();
    }

    public function getDataTamuUndanganDetail()
    {
        return $this->db->select("a.*, b.nama")
            ->from('tamu_undangan_detail a')
            ->join('tamu_undangan b', 'a.id_tamu_undangan = b.id', 'left')
            ->order_by('a.id', 'ASC')->get()->result();
    }

    public function getCountTamuKehadiran()
    {
        return $this->db->query("SELECT 
                                    'Hadir' as name,
                                    count(id) as value
                                FROM tamu_undangan_detail 
                                where is_hadir = 'Hadir'
                                
                                UNION ALL
                                
                                SELECT 
                                    'Tidak Hadir' as name,
                                    count(id) as value
                                FROM tamu_undangan_detail 
                                where is_hadir = 'Tidak Hadir'
                                
                                UNION ALL
                                
                                SELECT 
                                    'Belum Pasti' as name,
                                    count(id) as value
                                FROM tamu_undangan_detail 
                                where is_hadir = 'Belum Pasti'")->result();
    }
}
