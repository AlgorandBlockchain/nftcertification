<?php

class Auth extends CI_Controller
{
	public function logout() {
		unset($_SESSION);
		session_destroy();
		redirect("auth/login");
	}
	public function login()
	{
		if (isset($_POST['login'])) {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == TRUE) {
				$username = $_POST['username'];
				$password = md5($_POST['password']);
				$this->db->select('*');
				$this->db->from('myuser');
				$this->db->where(array('user' => $username, 'pass' => $password));
				$query = $this->db->get();
				$user = $query->row();
				if (($query->num_rows()>0)&&($user->user)) {
					$this->session->set_flashdata("success", "you are login");
					$_SESSION['user_logged'] = TRUE;
					$_SESSION['username'] = $user->user;
					$_SESSION["is_login"] = "yes";
					$_SESSION["sess_user_id"] = $user->id;
					$_SESSION["sess_name"] = $user->nama;
					$_SESSION["sess_uname"] = $user->user;
					if (($user->status == 0)||($user->aktif == 0)) {
						$id = $_SESSION["sess_user_id"];
						$datax = array(
								'status'=>'1',
								'aktif'=>'1'
						);
						$this->db->where('id', $id);
     				$this->db->update('myuser', $datax);

					}

					redirect("home/dasboard", "refresh");

				} else {
						$this->session->set_flashdata("error", "Username atau password salah");
						redirect("auth/login", "refresh");
						$this->session->set_flashdata("error", "Username atau password salah");
					}
			}
			$this->load->view('login');

		}
		else if (isset($_POST['lupa'])) {
			$this->form_validation->set_rules('email_lupa', 'email_lupa', 'required');
			if ($this->form_validation->run() == TRUE) {
				$email = $_POST["email_lupa"];
				$this->db->select('*');
				$this->db->from('myuser');
				$this->db->where(array('email' => $email));
				$query = $this->db->get();
				$user = $query->row();
				if (($query->num_rows()==1)&&($user->email)) {
					$password_lupa = $user->pass2;
					$username = $user->user;
					//
					$keterangan = "Username : ".$username." \npassword : ".$password_lupa;
					date_default_timezone_set('Asia/Jakarta');
  					$date = new DateTime();
  					$tgl_email = date_format($date, 'Y-m-d H:i:s');
  					$from_email = "dikikarim2010@gmail.com"; //from mail, it is mandatory with some hosts
					$recipient_email = $email; //recipient email (most cases it is your personal email)//Capture POST data from HTML form and Sanitize them,
					$sender_name = filter_var("Kabisaku.com", FILTER_SANITIZE_STRING); //sender name
					$reply_to_email = filter_var("no-reply", FILTER_SANITIZE_STRING); //sender email used in “reply-to” header
					$subject = filter_var('Lupa Email Kabisaku' , FILTER_SANITIZE_STRING); //get subject from HTML form
					$message = filter_var($keterangan, FILTER_SANITIZE_STRING); //message
					/* //don’t forget to validate empty fields
					if(strlen($sender_name)<1){
					die(‘Name is too short or empty!’);
					}
					*/
					$boundary = md5("sanwebe");
					//header
					$headers = "MIME-Version: 1.0\r\n";
					$headers .= "From:".$from_email."\r\n";
					$headers .= "Reply-To: no-reply" . "\r\n";
					$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

					//plain text
					$body = "--$boundary\r\n";
					$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
					$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
					$body .= chunk_split(base64_encode($message));

					$sentMail = @mail($recipient_email, $subject, $body, $headers);
					$this->session->set_flashdata("success", "Username dan password telah terkirim, silahkan periksa email anda");
					redirect("auth/lupa", "refresh");
					$this->session->set_flashdata("success", "Username dan password telah terkirim, silahkan periksa email anda");

					//

				} else {
						$this->session->set_flashdata("error", "email belum terdaftar");
						redirect("auth/lupa", "refresh");
						$this->session->set_flashdata("error", "email belum terdaftar");
					}
			}
			$this->load->view('lupa');
		} else {
				$this->load->view('login');
			}

		
	}


	public function lupa()
	{
		if (isset($_POST['lupa'])) {
			$this->form_validation->set_rules('email_lupa', 'email_lupa', 'required');
			if ($this->form_validation->run() == TRUE) {
				$email = $_POST['email_lupa'];
				$this->db->select('*');
				$this->db->from('myuser');
				$this->db->where(array('email' => $email));
				$query = $this->db->get();
				$user = $query->row();
				if (($query->num_rows()>0)&&($user->email)) {
					$password_lupa = $user->pass2;
					$username = $user->user;
					//
					$keterangan = "Username : ".$username." \npassword : ".$password_lupa;
					date_default_timezone_set('Asia/Jakarta');
  					$date = new DateTime();
  					$tgl_email = date_format($date, 'Y-m-d H:i:s');
  					$from_email = "dikikarim2010@gmail.com"; //from mail, it is mandatory with some hosts
					$recipient_email = $email; //recipient email (most cases it is your personal email)//Capture POST data from HTML form and Sanitize them,
					$sender_name = filter_var("Kabisaku.com", FILTER_SANITIZE_STRING); //sender name
					$reply_to_email = filter_var("no-reply", FILTER_SANITIZE_STRING); //sender email used in “reply-to” header
					$subject = filter_var('Lupa Email Kabisaku' , FILTER_SANITIZE_STRING); //get subject from HTML form
					$message = filter_var($keterangan, FILTER_SANITIZE_STRING); //message
					/* //don’t forget to validate empty fields
					if(strlen($sender_name)<1){
					die(‘Name is too short or empty!’);
					}
					*/
					$boundary = md5("sanwebe");
					//header
					$headers = "MIME-Version: 1.0\r\n";
					$headers .= "From:".$from_email."\r\n";
					$headers .= "Reply-To: no-reply" . "\r\n";
					$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

					//plain text
					$body = "--$boundary\r\n";
					$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
					$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
					$body .= chunk_split(base64_encode($message));

					$sentMail = @mail($recipient_email, $subject, $body, $headers);
					$this->session->set_flashdata("success", "Username dan password telah terkirim, silahkan periksa email anda");
					redirect("auth/lupa", "refresh");
					$this->session->set_flashdata("success", "Username dan password telah terkirim, silahkan periksa email anda");
					//

				} else {
						$this->session->set_flashdata("error", "email belum terdaftar");
						redirect("auth/lupa", "refresh");
						$this->session->set_flashdata("error", "email belum terdaftar");

					}
			}
		} else {
			$this->load->view('lupa');
			}
	}

	public function register()
	{
		if (isset($_POST['register'])) {
			$this->form_validation->set_rules('emailx', 'Email', 'required');
			$this->form_validation->set_rules('usernamex', 'Username', 'required');
			//$this->form_validation->set_rules('passwordx', 'Password', 'required|min_length[5]');
			//$this->form_validation->set_rules('passwordxx', 'Repeat Password', 'required|min_length[5]|matches[passwordx]');
			$this->form_validation->set_rules('acceptx', 'Accept User Agreement', 'required');
			if ($this->form_validation->run() == TRUE) {
				$hari_ini = date("Ymd");
	      //$sqltran = "SELECT max(id) AS last FROM kdspj WHERE id LIKE '$hari_ini%'";
	      //$sqltranx = mysql_query($sqltran);
	      //$data  = mysql_fetch_array($sqltranx);
	      //$lastNoTransaksi = $data['last'];

	      // baca nomor urut transaksi dari id transaksi terakhir
	      //$lastNoUrut = substr($lastNoTransaksi, 8, 4);
	      // nomor urut ditambah 1
	      //$nextNoUrut = $lastNoUrut + 1;

	      // membuat format nomor transaksi berikutnya
	      //$nextNoTransaksi = $hari_ini.sprintf('%04s', $nextNoUrut);
				$this->db->select('max(id) AS last');
				$this->db->from('myuser');
				$where = "id LIKE '%".$hari_ini."%'";
				$this->db->where($where);
				$query = $this->db->get();
				$data = $query->row();
				if ($data->last) {
					$lastNoTransaksi = $data->last;
					$lastNoUrut = substr($lastNoTransaksi, 8, 4);
					$nextNoUrut = $lastNoUrut + 1;
				} else {
						$nextNoUrut =  1;
					}
				$nextNoTransaksi = $hari_ini.sprintf('%04s', $nextNoUrut);
				$password = rand(0, 100000000);
				$datax = array(
						'id'=>$nextNoTransaksi,
						'user'=>$_POST['usernamex'],
						'email'=>$_POST['emailx'],
						'pass'=>md5($password),
						'pass2'=>$password,
						'kelasuser'=>'user',
						'status'=>'0',
						'kode_email'=>md5($_POST['emailx'])
				);
				$this->db->insert('myuser', $datax);
				$datay = array(
						'userid'=>$nextNoTransaksi,
						'username'=>$_POST['usernamex'],
						'email'=>$_POST['emailx']
				);
				$this->db->insert('tprofiluser', $datay);
				$keterangan = "Username : ".$_POST['usernamex']."\npassword : ".$password;
				date_default_timezone_set('Asia/Jakarta');
  				$date = new DateTime();
  				$tgl_email = date_format($date, 'Y-m-d H:i:s');
  				$from_email = "dikikarim2010@gmail.com"; //from mail, it is mandatory with some hosts
				$recipient_email = $_POST['emailx']; //recipient email (most cases it is your personal email)//Capture POST data from HTML form and Sanitize them,
				$sender_name = filter_var("Kabisaku.com", FILTER_SANITIZE_STRING); //sender name
				$reply_to_email = filter_var("no-reply", FILTER_SANITIZE_STRING); //sender email used in “reply-to” header
				$subject = filter_var('Registrasi Kabisaku' , FILTER_SANITIZE_STRING); //get subject from HTML form
				$message = filter_var($keterangan, FILTER_SANITIZE_STRING); //message
				/* //don’t forget to validate empty fields
				if(strlen($sender_name)<1){
				die(‘Name is too short or empty!’);
				}
				*/
				$boundary = md5("sanwebe");
				//header
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From:".$from_email."\r\n";
				$headers .= "Reply-To: no-reply" . "\r\n";
				$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

				//plain text
				$body = "--$boundary\r\n";
				$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
				$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
				$body .= chunk_split(base64_encode($message));

				$sentMail = @mail($recipient_email, $subject, $body, $headers);
	      		//$SQL = "insert into kdspj(id) values('".$nextNoTransaksi."')";
			  	//$hasil = mysql_query($SQL);

			}

		}
		$this->load->view('register');
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

}
