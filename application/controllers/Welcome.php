<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('template');
		$this->load->model('MempelaiModel', 'Mempelai');
		$this->load->model('AcaraModel', 'Acara');
		$this->load->model('GaleryModel', 'Galery');
		$this->load->model('BannerModel', 'Banner');
		$this->load->model('MapsModel', 'Maps');
		$this->load->model('RekeningHadiahModel', 'RekeningHadiah');
		$this->load->model('AudioModel', 'Audio');
	}

	public function index()
	{
		$kepada = $this->input->get('kepada');
		if (isset($kepada)) {
			$cekDataTamuUndangan = where_row('tamu_undangan', ['slug' => $kepada]);
			$cekDataUcapanTamuUndangan = where_row('tamu_undangan_detail', ['id_tamu_undangan' => $cekDataTamuUndangan->id]);
			if (!$cekDataTamuUndangan) show_404();
		}

		$dataMempelaiPria = $this->Mempelai->getDataMempelaiByGender(1);
		$dataMempelaiWanita = $this->Mempelai->getDataMempelaiByGender(2);

		$data = [
			'title' => $dataMempelaiWanita->nama_panggilan . ' & ' . $dataMempelaiPria->nama_panggilan,
			'dataMempelai' => [
				'pria' => $dataMempelaiPria,
				'wanita' => $dataMempelaiWanita,
			],
			'dataSosialMediaMempelai' => [
				'pria' => $this->Mempelai->getDataSosialMediaByGender(1),
				'wanita' => $this->Mempelai->getDataSosialMediaByGender(2),
			],
			'dataAcara' => [
				'akad' => $this->Acara->getDataAcaraByType('Akad Nikah'),
				'resepsi' => $this->Acara->getDataAcaraByType('Resepsi'),
			],
			'dataGalery' => $this->Galery->getDataGalery(),
			'bannerUtama' =>  $this->Banner->getDataBanner('primary'),
			'bannerSecond' => $this->Banner->getDataBanner('second'),
			'dataMaps' => $this->Maps->getDataMaps(),
			'dataRekening' => $this->RekeningHadiah->getDataRekeningHadiah(),
			'dataAudio' => $this->Audio->getDataAudio(),
			'dataTamuUndangan' => isset($kepada) ? $cekDataTamuUndangan : null,
			'dataUcapanTamuUndanganById' => isset($kepada) ? $cekDataUcapanTamuUndangan : null,
		];

		$this->load->view('frontend/app', $data);
	}

	public function store()
	{
		header('Content-Type: application/json');
		$dataPost = json_decode(file_get_contents("php://input"));

		$this->db->trans_begin();

		insert_table('tamu_undangan_detail', [
			'id_tamu_undangan' => $dataPost->id,
			'is_hadir' => (int)$dataPost->kehadiran,
			'pesan' => $dataPost->pesan,
			'created_at' => date('Y-m-d H:i:s')
		]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode([
				'status' => false,
				'message' => "Kirim ucapan ke mempelai gagal, silahkan coba kembali",
			]);
		} else {
			$this->db->trans_commit();
			echo json_encode([
				'status' => true,
				'message' => "Kirim ucapan ke mempelai berhasil, terimakasih atas ucapannya ❤️",
			]);
		}
	}

	public function getUcapan()
	{
		$data = $this->db->select("a.*, b.nama")
			->from('tamu_undangan_detail a')
			->join('tamu_undangan b', 'a.id_tamu_undangan = b.id', 'left')->get()->result();

		echo json_encode($data);
	}
}
