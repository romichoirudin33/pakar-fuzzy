<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') !== 'pengguna' || $this->session->userdata('status') == null) {
			redirect('login','refresh');
		}
		$this->load->model('Gejala_model');
		$this->load->model('Penyakit_model');
		$this->load->model('Penyakit_detail_model');
	}

	public function index()
	{
		$object['data'] = $this->Gejala_model->readAll();
		$this->load->view('analisa_view', $object);
	}

	public function cek()
	{
		if ($this->input->post('submit')) {
			$data = array(); //data gejala_id

			foreach ($this->input->post('id') as $key => $value) {
				array_push($data, $value);
			}
			
			if (count($data) < 4) {
				$penyakitDetail = $this->Penyakit_detail_model->cekPenyakitRand($data);
				print_r($penyakitDetail);
				foreach ($penyakitDetail as $key) {
					$idPenyakit = $key->penyakit_id;
				}

				$awal = 1;
				foreach ($this->input->post('range') as $key => $value) {
					if ($value !== "") {
						$gejala[$awal] = $value;
						$awal += 1;	
					}
				}
				$gejala[$awal] = rand(30, 50);
				$awal += 1;	
				$gejala[$awal] = rand(25, 40);
			}else{
				$penyakitDetail = $this->Penyakit_detail_model->cekPenyakit($data);
				$penyakit_id = array();
				foreach ($penyakitDetail as $key) {
					foreach ($key as $k => $value) {
						array_push($penyakit_id, $value);
					}
				}

				foreach(array_count_values($penyakit_id) as $k => $v){
					if ($v > 1) {
						$idPenyakit = $k;
					}
				}

				$awal = 1;
				foreach ($this->input->post('range') as $key => $value) {
					if ($value !== "") {
						$gejala[$awal] = $value;
						$awal += 1;	
					}
				}
			}
		
		//-----------------------------proses fuzzifikasi---------------------------------//
		$fuzz;
		foreach ($gejala as $key => $value) {

			//ini fuzzifikasi ringan
			if ($value <= 20) {
				$fuzz[1][$key] = 1;
			}else if ($value >= 20 and $value <= 50) {
				$fuzz[1][$key] = (50 - $value) / 30;
			}else{
				$fuzz[1][$key] = 0;
			}

			//ini fuzzifikasi sedang
			if (($value <= 20 or $value >= 80)) {
				$fuzz[2][$key] = 0;
			}else if ($value >= 20 and $value <= 50) {
				$fuzz[2][$key] = ($value - 20) / 30;
			}else if ($value >= 50 and $value <= 80) {
				$fuzz[2][$key] = (80-$value) / 30;
			}

			//ini fuzzifikasi berat
			if ($value <= 50) {
				$fuzz[3][$key] = 0;
			}else if ($value >= 50 and $value <= 80) {
				$fuzz[3][$key] = ($value - 50) / 30;
			}else{
				$fuzz[3][$key] = 1;
			}
		}
		// print_r($fuzz);
		// echo "<br>";
		$in = 0;

		//-----------------------------proses implikasi---------------------------------//
		$a = array();
		$hangusBatang = array(); //simpan nilai hangus batang
		$index = 0;
		for ($i=1; $i < 4; $i++) { 
			for ($j=1; $j < 4; $j++) { 
				for ($q=1; $q < 4; $q++) { 
					for ($r=1; $r < 4; $r++) { 
						array_push($a, min($fuzz[$i][1],$fuzz[$j][2],$fuzz[$q][3],$fuzz[$r][4]));
						// echo $a[$in];
						echo " ";
						if ($a[$in] != 0) {
							if ($a[$in] == $fuzz[$i][1]) { //leher akar mengecil
								// echo $a[$in]." ".$in.". hangus batang ";
								if ($i == 1) {
									$hangusBatang[$index][1] = $a[$in];
									// echo "ringan";
								}else if ($i == 2) {
									$hangusBatang[$index][2] = $a[$in];
									// echo "sedang";
								}else if ($i == 3) {
									$hangusBatang[$index][3] = $a[$in];
									// echo "berat";
								}
							}else if ($a[$in] == $fuzz[$j][2]) { //batang mengering
								// echo $a[$in]." ".$in.". hangus batang ";
								if ($j == 1) {
									$hangusBatang[$index][1] = $a[$in];
									// echo "ringan";
								}else if ($j == 2) {
									$hangusBatang[$index][2] = $a[$in];
									// echo "sedang";
								}else if ($j == 3) {
									$hangusBatang[$index][3] = $a[$in];
									// echo "berat";
								}
							}else if ($a[$in] == $fuzz[$q][3]) { //batang akar membusuk
								// echo $a[$in]." ".$in.". hangus batang ";
								if ($q == 1) {
									$hangusBatang[$index][1] = $a[$in];
									// echo "ringan";
								}else if ($q == 2) {
									$hangusBatang[$index][2] = $a[$in];
									// echo "sedang";
								}else if ($q == 3) {
									$hangusBatang[$index][3] = $a[$in];
									// echo "berat";
								}
							}else if ($a[$in] == $fuzz[$r][4]) { //batang berkerut
								// echo $a[$in]." ".$in.". hangus batang ";
								if ($q == 1) {
									$hangusBatang[$index][1] = $a[$in];
									// echo "ringan";
								}else if ($q == 2) {
									$hangusBatang[$index][2] = $a[$in];
									// echo "sedang";
								}else if ($q == 3) {
									$hangusBatang[$index][3] = $a[$in];
									// echo "berat";
								}
							}
							$index+=1;
							// echo "<br>";
						}
						$in += 1;
					}
				}
			}
		}

		//-----------------------------proses agregrasi---------------------------------//
		// echo "<br>";
		// print_r($hangusBatang);
		// echo "<br>";
		$titikPotong = 1;
		foreach ($hangusBatang as $key) {
			foreach ($key as $keys => $value) {
				
				// echo $keys." ".$value;
				if ($value <= $titikPotong) {
					$titikPotong = $value;
				}

				if ($keys == 1) {
					$titikMax = $value;
					$b[1] = 50 - ($value * 30);
				}

				if ($keys == 2) {
					$b[2] = ($value * 30) + 20;
					$b[3] = 80 - ($value * 30);
				}
				// echo "<br>";
			}
		}

		// echo $titikPotong ." ";
		sort($b);
		// print_r($b);
		// echo "<br>";

		//-----------------------------proses defuzzifikasi---------------------------------//
		$usf;
		for ($i=0; $i < 4; $i++) { 
			if ($i == 0) {
				$usf[$i] = $titikPotong * (0.5 * pow($b[0], 2));
			}else if ($i == 1) {
				$usf[$i] = ((0.01 * pow($b[1], 3)) - (0.335 * pow($b[1], 2))) - ((0.01 * pow($b[0], 3)) - (0.335 * pow($b[0], 2)));
			}else if ($i == 2) {
				$usf[$i] = $titikPotong * ((0.5 * pow($b[2], 2)) - (0.5 * pow($b[0], 2)));
			}else if ($i == 3) {
				$usf[$i] = ((-0.01 * pow(80, 3)) + (1.335 * pow(80, 2))) - ((-0.01 * pow($b[2], 3)) + (1.335 * pow($b[2], 2)));
			}
		}
		// print_r($usf);

		//-----------------------------proses menghitung luas---------------------------------//
		$luasA;
		for ($i=0; $i < 4; $i++) { 
			if ($i == 0) {
				$luasA[$i] = $titikPotong * $b[0];
			}else if ($i == 1) {
				$luasA[$i] = ($titikPotong + $titikMax) * (($b[1]-$b[0])/2);
			}else if ($i == 2) {
				$luasA[$i] = ($b[2] - $b[0]) * $titikPotong;
			}else if ($i == 3) {
				$luasA[$i] = (80 - $b[2]) * ($titikPotong/2);
			}
		}
		// echo "<br>";
		// print_r($luasA);
		// echo "<br>";

		//-----------------------------proses menghitung titik pusat---------------------------------//
		$atas = 0;
		$bawah = 0;
		for ($i=0; $i < 4; $i++) { 
			$atas += $usf[$i];
			$bawah += $luasA[$i];
		}
		$z = $atas/$bawah;
		$object['hasil'] = round($z, 3);

		//-----------------------------menampilkan hasil ke view---------------------------------//
		$object['data'] = $this->Gejala_model->readAll();
		$object['penyakit'] = $this->Penyakit_model->readId($idPenyakit);
		$this->load->view('analisa_hasil', $object);
	}else{
		redirect('analisa');
	}

	}

}