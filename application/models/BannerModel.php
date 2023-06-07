<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class BannerModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function getDataBanner($position)
    {
        return $this->db->select("*")->from("banner")->where('position', $position)->get()->row();
    }
}
