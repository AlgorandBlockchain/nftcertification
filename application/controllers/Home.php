<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (($_SESSION['user_logged']) == FALSE) {
			$this->session->set_flashdata("error", "Please login first to view this page!!");
			redirect("auth/login");
		}

	}

	public function profile()
	{
		if (($_SESSION['user_logged']) == FALSE) {
			$this->session->set_flashdata("error", "Please login first to view this page!!");
			redirect("auth/login");
		}
		$data['title'] = "MySkills";
		$data['subtitle'] = "Profile";
		$data['description'] = "Beranda Kabisaku";
		$data['view_isi'] = "profile";
		if ( $this->input->post('kota')=="") {$kota = "";}else {$kota =  $this->input->post('kota');}
		if ( $this->input->post('kec')=="") {$kec = "";}else {$kec =  $this->input->post('kec');}
		if ( $this->input->post('kel')=="") {$kel = "";}else {$kel =  $this->input->post('kel');}
		if (isset($_POST['save'])) {
			$id = $_SESSION["sess_user_id"];
			$datax = array(
					'tgl_lahir'=>$_POST['tgl_lahir'],
					'genre'=>$_POST['gender'],
					'first_name'=>$_POST['first_name'],
					'last_name'=>$_POST['last_name'],
					'warga_negara'=>$_POST['warga_negara'],
					'provinsi'=>$_POST['prop'],
					'kota'=>$kota,
					'no_telp'=>$_POST['no_telp'],
					'alamat_web'=>$_POST['alamat_web'],
					'alamat_facebook'=>$_POST['alamat_facebook'],
					'alamat_twitter'=>$_POST['alamat_twitter'],
					'alamat_google'=>$_POST['alamat_google'],
					'kecamatan'=>$kec,
					'kelurahan'=>$kel
			);
			$this->db->where('userid', $id);
			$this->db->update('tprofiluser', $datax);

		}
		$this->load->view('layout/template_top_profile',$data);
	}

	public function dasboard()
	{
		if (($_SESSION['user_logged']) == FALSE) {
			$this->session->set_flashdata("error", "Please login first to view this page!!");
			redirect("auth/login");
		}
		$data['title'] = "Myskills";
		$data['subtitle'] = "Home";
		$data['description'] = "Beranda";
		$data['view_isi'] = "dasboard";
		if ( $this->input->post('prop')=="") {$provinsi = "";}else {$provinsi =  $this->input->post('prop');}
		if ( $this->input->post('kota')=="") {$kota = "";}else {$kota =  $this->input->post('kota');}
		if ( $this->input->post('kec')=="") {$kec = "";}else {$kec =  $this->input->post('kec');}
		if ( $this->input->post('kel')=="") {$kel = "";}else {$kel =  $this->input->post('kel');}
		if (isset($_POST['save'])) {
			$id = $_SESSION["sess_user_id"];
			$datax = array(
					'provinsi'=>$provinsi,
					'kota'=>$kota,
					'kecamatan'=>$kec,
					'kelurahan'=>$kel
			);
			$this->db->where('userid', $id);
			$this->db->update('tprofiluser', $datax);
		}
		$this->load->view('layout/template_top',$data);
	}

	public function index()
	{

		redirect("auth/login", "refresh");
	}

	public function gate_state()
   {
      //set selected country id from POST
      $id_country = $_GET['country_id'];
      //run the query for the cities we specified earlier
      //$districtData['districtDrop']=$this->cities_countries_model->getCityByCountry($id_country);

			$this->db->select('*');
			$this->db->from('regions');
			$where = "country_id = '".$id_country."' and name <> ''";
			$this->db->where($where);
			$query = $this->db->get();
			$output = "";
			$output .= '<select class="chosen-select form-control" name="provinsi" id="provinsi" data-placeholder="Choose a State..." onChange="getCityY(this.value);">';
      foreach ($query->result() as $row)
      {
         //here we build a dropdown item line for each query result
         $output .= "<option value='".$row->id."'>".$row->name."</option>";
      }
			$output .= '</select>';
      echo $output;
   }

	 public function gate_city()
    {
       //set selected country id from POST
       $id_country = $_GET['country_id'];
			 $id_region = $_GET['region_id'];
       //run the query for the cities we specified earlier
       //$districtData['districtDrop']=$this->cities_countries_model->getCityByCountry($id_country);

 			$this->db->select('*');
 			$this->db->from('cities');
 			$where = "country_id = '".$id_country."' and name <> '' and region_id = '".$id_region."'";
 			$this->db->where($where);
 			$query = $this->db->get();
 			$output = "";
 			$output .= '<select class="chosen-select form-control" name="kota" id="kota" data-placeholder="Choose a cities...">';
       foreach ($query->result() as $row)
       {
          //here we build a dropdown item line for each query result
          $output .= "<option value='".$row->id."'>".$row->name."</option>";
       }
 			$output .= '</select>';
       echo $output;
    }

	public function my_skill()
	{
		if (($_SESSION['user_logged']) == FALSE) {
			$this->session->set_flashdata("error", "Please login first to view this page!!");
			redirect("auth/login");
		}
		$data['title'] = "MySkills";
		$data['subtitle'] = "Skills";
		$data['description'] = "Keahlian Saya";
		$data['view_isi'] = "my_skill";
		$this->load->view('layout/template_scrud',$data);
	}

	public function my_job_experience()
	{
		if (($_SESSION['user_logged']) == FALSE) {
			$this->session->set_flashdata("error", "Please login first to view this page!!");
			redirect("auth/login");
		}
		$data['title'] = "MySkills";
		$data['subtitle'] = "Work experience";
		$data['description'] = "Pengalaman Kerja";
		$data['view_isi'] = "my_job_experience";
		$this->load->view('layout/template_pengalaman',$data);
	}

	public function formal_education()
	{
		if (($_SESSION['user_logged']) == FALSE) {
			$this->session->set_flashdata("error", "Please login first to view this page!!");
			redirect("auth/login");
		}
		$data['title'] = "MySkills";
		$data['subtitle'] = "Formal education";
		$data['description'] = "Pendidikan Formal";
		$data['view_isi'] = "formal_education";
		$this->load->view('layout/template_formal_edu',$data);
	}

	public function non_formal_education()
	{
		if (($_SESSION['user_logged']) == FALSE) {
			$this->session->set_flashdata("error", "Please login first to view this page!!");
			redirect("auth/login");
		}
		$data['title'] = "MySkills";
		$data['subtitle'] = "Non-formal education";
		$data['description'] = "Pendidikan Non Formal";
		$data['view_isi'] = "non_formal_education";
		$this->load->view('layout/template_nonformal_edu',$data);
	}


	public function select_kota()
   {
    	//
			if (!empty($_GET['q'])){
				if (ctype_digit($_GET['q'])) {
					$query = $this->db->query("SELECT * FROM inf_lokasi where lokasi_propinsi=$_GET[q] and lokasi_kecamatan=0 and lokasi_kelurahan=0 and lokasi_kabupatenkota!=0 order by lokasi_nama");
					echo"<option selected value=''>Pilih Kota/Kab</option>";
					foreach($query->result() as $d) {
						echo "<option value='$d->lokasi_kabupatenkota'>$d->lokasi_nama </option>";
					}
				}
			}

			if (empty($_GET['kel'])){
				if (!empty($_GET['kec']) and !empty($_GET['prop'])){
					if (ctype_digit($_GET['kec']) and ctype_digit($_GET['prop'])) {
						$query = $this->db->query("SELECT * FROM inf_lokasi where lokasi_propinsi=$_GET[prop] and lokasi_kecamatan!=0 and lokasi_kelurahan=0 and lokasi_kabupatenkota=$_GET[kec] order by lokasi_nama");
						echo"<option selected value=''>Pilih Kecamatan</option>";
						foreach($query->result() as $d) {
							echo "<option value='$d->lokasi_kecamatan'>$d->lokasi_nama</option>";
						}
					}
				}
			}

			else {
				if (!empty($_GET['kec']) and !empty($_GET['prop'])){
					if (ctype_digit($_GET['kec']) and ctype_digit($_GET['prop'])) {
						$query = $this->db->query("SELECT * FROM inf_lokasi where lokasi_propinsi=$_GET[prop] and lokasi_kecamatan=$_GET[kel] and lokasi_kelurahan!=0 and lokasi_kabupatenkota=$_GET[kec] order by lokasi_nama");
						echo"<option selected value=''>Pilih Kelurahan/Desa</option>";
						foreach($query->result() as $d) {
							echo "<option value='$d->lokasi_kelurahan'>$d->lokasi_nama</option>";
						}
					}
				}
			}
			//
   }

	public function pencarian()
 	{
 		if (($_SESSION['user_logged']) == FALSE) {
 			$this->session->set_flashdata("error", "Please login first to view this page!!");
 			redirect("auth/login");
 		}
		if ( $this->input->post('prop')=="") {$provinsi = "";}else {$provinsi =  $this->input->post('prop');}
		if ( $this->input->post('kota')=="") {$kota = "";}else {$kota =  $this->input->post('kota');}
		if ( $this->input->post('kec')=="") {$kecamatan = "";}else {$kecamatan =  $this->input->post('kec');}
		if ( $this->input->post('kel')=="") {$kelurahan = "";}else {$kelurahan =  $this->input->post('kel');}
		if ( $this->input->post('gender')=="") {$genre = "";}else {$genre =  $this->input->post('gender');}
		if ( $this->input->post('skill')=="") {$skill = "";}else {$skill =  $this->input->post('skill');}
 		$data['title'] = "MySkills";
 		$data['subtitle'] = "Search";
 		$data['description'] = "Pencarian";
		$data['provinsi'] = $provinsi;
		$data['kota'] = $kota;
		$data['kecamatan'] = $kecamatan;
		$data['kelurahan'] = $kelurahan;
		$data['genre'] = $genre;
		$data['keahlian'] = $skill;
 		$data['view_isi'] = "pencarian";
 		$this->load->view('layout/template_pencarian',$data);
 	}

   public function searchskill()
   {
      //set selected country id from POST
      $input = $_GET['input'];
      //run the query for the cities we specified earlier
      //$districtData['districtDrop']=$this->cities_countries_model->getCityByCountry($id_country);

			$this->db->select('*');
			$this->db->from('tmyskill');
			$where = "skill LIKE '%$input%'";
			$this->db->where($where);
			$this->db->group_by('skill');
			$query = $this->db->get();
			?><table style="border: 1px solid grey" width=100%><?
			//if ($query->num_rows>0) {
			foreach ($query->result() as $row)
      {

         ?><tr><td width="100%" style="border:1px solid #ccc"><a href="javascript:autoInsertSkill('<?=$row->skill?>');"><?=$row->skill?></a></td></tr><?
      }
			?></table><?
   }

   public function pencarian_utama()
 	{
 		
		if ( $this->input->post('prop')=="") {$provinsi = "";}else {$provinsi =  $this->input->post('prop');}
		if ( $this->input->post('kota')=="") {$kota = "";}else {$kota =  $this->input->post('kota');}
		if ( $this->input->post('kec')=="") {$kecamatan = "";}else {$kecamatan =  $this->input->post('kec');}
		if ( $this->input->post('kel')=="") {$kelurahan = "";}else {$kelurahan =  $this->input->post('kel');}
		if ( $this->input->post('gender')=="") {$genre = "";}else {$genre =  $this->input->post('gender');}
		if ( $this->input->post('skill')=="") {$skill = "";}else {$skill =  $this->input->post('skill');}
 		$data['title'] = "MySkills";
 		$data['subtitle'] = "Search";
 		$data['description'] = "Pencarian";
		$data['provinsi'] = $provinsi;
		$data['kota'] = $kota;
		$data['kecamatan'] = $kecamatan;
		$data['kelurahan'] = $kelurahan;
		$data['genre'] = $genre;
		$data['keahlian'] = $skill;
 		$data['view_isi'] = "pencarian_utama";
 		$this->load->view('layout/template_pencarian_utama',$data);
 	}

}
