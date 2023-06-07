<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class AudioModel extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function getDataAudio()
    {
        return $this->db->select("*")->from("audio")->get()->result();
    }
}
