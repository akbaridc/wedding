<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('where_count')) {
  function where_count($table, $where)
  {
    $app = &get_instance();
    return $app->db->get_where($table, $where)->num_rows();
  }
}
if (!function_exists('where_row')) {
  function where_row($table, $where)
  {
    $app = &get_instance();
    return $app->db->get_where($table, $where)->row();
  }
}
if (!function_exists('where_result')) {
  function where_result($table, $where)
  {
    $app = &get_instance();
    return $app->db->order_by('id', 'desc')->get_where($table, $where)->result();
  }
}
if (!function_exists('show_data')) {
  function show_data($table)
  {
    $app = &get_instance();
    return $app->db->order_by('id', 'desc')->get($table)->result();
  }
}
if (!function_exists('where_count')) {
  function where_count($table, $where)
  {
    $app = &get_instance();
    return $app->db->get_where($table, $where)->num_rows();
  }
}
if (!function_exists('count_table')) {
  function count_table($table)
  {
    $app = &get_instance();
    return $app->db->get($table)->num_rows();
  }
}
if (!function_exists('insert_table')) {
  function insert_table($table, $data)
  {
    $app = &get_instance();
    return $app->db->insert($table, $data);
  }
}
if (!function_exists('update_table')) {
  function update_table($table, $data, $where)
  {
    $app = &get_instance();
    return $app->db->update($table, $data, $where);
  }
}
if (!function_exists('post')) {
  function post($record)
  {
    $app = &get_instance();
    $data = $app->input->post();
    return filter_var($data[$record]);
  }
}
if (!function_exists('create_pass')) {
  function create_pass($record)
  {
    $app = &get_instance();
    $p = password_hash($record, PASSWORD_DEFAULT);
    return $p;
  }
}

if (!function_exists("cek_post")) {
  function cek_post()
  {
    $app = &get_instance();
    $data = $app->input->post();
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      redirect("forbiden");
    }
  }
}
if (!function_exists("cek_session")) {
  function cek_session()
  {
    $app = &get_instance();
    $data = $app->session->userdata('login');
    if (!$data) {
      redirect("login-administrator");
    } else {
      return;
    }
  }
}
if (!function_exists("rupiah")) {
  function rupiah($number)
  {
    $app = &get_instance();
    return "Rp. " . number_format($number, 0, '.', ',');
  }
}

if (!function_exists("formatRupiahExceptRp")) {
  function formatRupiahExceptRp($number)
  {
    $app = &get_instance();
    return number_format($number, 0, '.', ',');
  }
}

if (!function_exists('tgl_indo')) {
  function date_indo($tgl)
  {
    $ubah = gmdate($tgl, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
  }
}

if (!function_exists('bulan')) {
  function bulan($bln)
  {
    switch ($bln) {
      case 1:
        return "Januari";
        break;
      case 2:
        return "Februari";
        break;
      case 3:
        return "Maret";
        break;
      case 4:
        return "April";
        break;
      case 5:
        return "Mei";
        break;
      case 6:
        return "Juni";
        break;
      case 7:
        return "Juli";
        break;
      case 8:
        return "Agustus";
        break;
      case 9:
        return "September";
        break;
      case 10:
        return "Oktober";
        break;
      case 11:
        return "November";
        break;
      case 12:
        return "Desember";
        break;
    }
  }
}

//Format Shortdate
if (!function_exists('shortdate_indo')) {
  function shortdate_indo($tgl)
  {
    $ubah = gmdate($tgl, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = short_bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal . '/' . $bulan . '/' . $tahun;
  }
}

if (!function_exists('short_bulan')) {
  function short_bulan($bln)
  {
    switch ($bln) {
      case 1:
        return "01";
        break;
      case 2:
        return "02";
        break;
      case 3:
        return "03";
        break;
      case 4:
        return "04";
        break;
      case 5:
        return "05";
        break;
      case 6:
        return "06";
        break;
      case 7:
        return "07";
        break;
      case 8:
        return "08";
        break;
      case 9:
        return "09";
        break;
      case 10:
        return "10";
        break;
      case 11:
        return "11";
        break;
      case 12:
        return "12";
        break;
    }
  }
}

//Format Medium date
if (!function_exists('mediumdate_indo')) {
  function mediumdate_indo($tgl)
  {
    $ubah = gmdate($tgl, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = medium_bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal . '-' . $bulan . '-' . $tahun;
  }
}

if (!function_exists('medium_bulan')) {
  function medium_bulan($bln)
  {
    switch ($bln) {
      case 1:
        return "Jan";
        break;
      case 2:
        return "Feb";
        break;
      case 3:
        return "Mar";
        break;
      case 4:
        return "Apr";
        break;
      case 5:
        return "Mei";
        break;
      case 6:
        return "Jun";
        break;
      case 7:
        return "Jul";
        break;
      case 8:
        return "Ags";
        break;
      case 9:
        return "Sep";
        break;
      case 10:
        return "Okt";
        break;
      case 11:
        return "Nov";
        break;
      case 12:
        return "Des";
        break;
    }
  }
}

if (!function_exists('hari')) {
  function hari($params)
  {
    $nama_hari = "";
    if ($params == "Sunday") {
      $nama_hari = "Minggu";
    } else if ($params == "Monday") {
      $nama_hari = "Senin";
    } else if ($params == "Tuesday") {
      $nama_hari = "Selasa";
    } else if ($params == "Wednesday") {
      $nama_hari = "Rabu";
    } else if ($params == "Thursday") {
      $nama_hari = "Kamis";
    } else if ($params == "Friday") {
      $nama_hari = "Jumat";
    } else if ($params == "Saturday") {
      $nama_hari = "Sabtu";
    }

    return $nama_hari;
  }
}

//Long date indo Format
if (!function_exists('longdate_indo')) {
  function longdate_indo($tanggal)
  {
    $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tgl = $pecah[2];
    $bln = $pecah[1];
    $thn = $pecah[0];
    $bulan = bulan($pecah[1]);

    $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));

    return hari($nama) . ',' . $tgl . ' ' . $bulan . ' ' . $thn;
  }
}

if (!function_exists('time_elapsed_string')) {
  function time_elapsed_string($datetime)
  {

    date_default_timezone_set('Asia/Jakarta');

    $etime = time() - strtotime($datetime);
    if ($etime < 1) {
      return 'just now';
    }

    $a = array(
      12 * 30 * 24 * 60 * 60  => 'years',
      30 * 24 * 60 * 60       =>  'months',
      24 * 60 * 60            =>  'days',
      60 * 60             =>  'hours',
      60                  =>  'minutes',
      1                   =>  'seconds'
    );

    foreach ($a as $secs => $str) {
      $d = $etime / $secs;

      if ($d >= 1) {
        $r = round($d);
        return  $r . ' ' . $str . ($r > 1 ? '' : '') . ' ago';
      }
    }
  }
}

if (!function_exists("nameAplication")) {
  function nameAplication()
  {
    return "Wedding - Admin";
  }
}

if (!function_exists("strRand")) {
  function strRand($min, $max)
  {
    return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789'), $min, $max);
  }
}

if (!function_exists("createSlug")) {
  function createSlug($slug)
  {
    $spacesHypens = '/[^\-\s\pN\pL]+/u';

    $duplicateHypens = '/[\-\s]+/';

    $slug = preg_replace($spacesHypens, '', mb_strtolower($slug, 'UTF-8'));

    $slug = preg_replace($duplicateHypens, '-', $slug);

    $slug = trim($slug, '-');

    return $slug;
  }
}

if (!function_exists("convertDate")) {
  function convertDate($params, $date)
  {
    return date($params, strtotime($date));
  }
}

if (!function_exists("dateIndo")) {
  function dateIndo($date)
  {
    return convertDate('d', $date) . " " . bulan(convertDate('m', $date) < 10 ? ltrim(convertDate('m', $date), '0') : convertDate('m', $date)) . " " . convertDate('Y', $date) . " " . convertDate('H', $date) . ":" . convertDate('i', $date);
  }
}

if (!function_exists("convertPhone")) {
  function convertPhone($string)
  {
    //penulisan no hp 0832 1112 3333
    $string = str_replace(" ", "", $string);

    //penulisan no hp (0832) 1112 3333
    $string = str_replace("(", "", $string);

    //penulisan no hp (0832) 1112 3333
    $string = str_replace(")", "", $string);

    //penulisan no hp 0832.1112.3333
    $string = str_replace(".", "", $string);

    //cek apakah no hp mengandung karakter + dan 0-9
    if (!preg_match('/[^+0-9]/', trim($string))) {
      if (substr(trim($string), 0, 3) == '+62') {
        //cek apakah no hp karakter 1-3 adalah +62
        $string = trim($string);
      } else if (substr(trim($string), 0, 1) == '0') {
        //cek apakah no hp karakter 1-3 adalah 0
        $string = '+62' . substr(trim($string), 1);
      } else {
        $string = 'Format no hp yang dimasukkan tidak lengkap atau salah';
      }
    }

    return $string;
  }
}
