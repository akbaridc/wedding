<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class AcaraModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function getDataAcara()
    {
        return $this->db->select("acara.*, 
                    CASE 
                        WHEN mempelai.is_gender = 1 THEN 'Pria'
                        WHEN mempelai.is_gender = 2 THEN 'Wanita'
                        ELSE NULL
                    END AS gender
                , mempelai.alamat")
            ->from('acara')
            ->join('mempelai', 'acara.id_mempelai = mempelai.id', 'left')
            ->order_by('acara.id', 'ASC')->get()->result();
    }

    public function getDataAcaraByType($type)
    {
        return $this->db->select("acara.*,
                                  CASE 
                                    WHEN type = 'Akad Nikah' THEN 'akad'
                                    WHEN type = 'Resepsi' THEN 'resepsi'
                                    ELSE NULL
                                  END AS type_,
                                  CASE 
                                        WHEN mempelai.is_gender = 1 THEN 'Pria'
                                        WHEN mempelai.is_gender = 2 THEN 'Wanita'
                                        ELSE NULL
                                    END AS gender
                                 ,mempelai.is_gender, mempelai.alamat")
            ->from('acara')
            ->join('mempelai', 'acara.id_mempelai = mempelai.id', 'left')
            ->where('acara.type', $type)->get()->row();
    }
}
