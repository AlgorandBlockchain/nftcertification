<?php

require_once 'db_connect.php';

$output = array('data' => array());
$skill = $_GET['keahlian'];
if (strlen($skill)>3) {
$sql = "SELECT tprofiluser.userid, tprofiluser.first_name, tprofiluser.last_name, tprofiluser.no_telp,
 				tprofiluser.email, tmyskill.skill FROM tprofiluser INNER JOIN
				tmyskill ON tprofiluser.userid = tmyskill.userid where tmyskill.skill LIKE '%".$skill."%'";

	if ($_GET['provinsi']!="") {
		$provinsi = $_GET['provinsi'];
		$sql = $sql . " and tprofiluser.provinsi = '$provinsi'";
	}
	if ($_GET['genre']!="") {
		$genre = $_GET['genre'];
		$sql = $sql . " and tprofiluser.genre = '$genre'";
	}
	if ($_GET['kota']!="") {
		$kota = $_GET['kota'];
		$sql = $sql . " and tprofiluser.kota = '$kota'";
	}
	if ($_GET['kecamatan']!="") {
		$kecamatan = $_GET['kecamatan'];
		$sql = $sql . " and tprofiluser.kecamatan = '$kecamatan'";
	}
	if ($_GET['kelurahan']!="") {
		$kelurahan = $_GET['kelurahan'];
		$sql = $sql . " and tprofiluser.kelurahan = '$kelurahan'";
	}
} else {
	$sql = "SELECT tprofiluser.userid, tprofiluser.first_name, tprofiluser.last_name, tprofiluser.no_telp,
					tprofiluser.email, tmyskill.skill FROM tprofiluser INNER JOIN
					tmyskill ON tprofiluser.userid = tmyskill.userid where tprofiluser.userid = 0";
	}
$sql = $sql . " GROUP BY tprofiluser.userid";
$query = $connect->query($sql);

$x = 1;
if ($query->num_rows>0) {
while ($row = $query->fetch_assoc()) {
	$image = "../../payrollx/upload_image/uploads/default-avatar.png";
	$userid = $row['userid'];
	$sqli = "SELECT * FROM timage WHERE user_id = '$userid'";
	$queryi = $connect->query($sqli);
	while ($rowi = $queryi->fetch_assoc()) {
		$image = "../../".$rowi['lokasi_file'];
	}
	$gambar = '<img class="thumbnail inline no-margin-bottom" src="'.$image.'" height="60" align="middle">';
	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editMemberModal" onclick="editMember('.$row['id'].')"> <span class="glyphicon glyphicon-edit"></span> Detail</a></li>
	  </ul>
	</div>';
	$nama = $row['first_name']. " " .$row['last_name'];
	$output['data'][] = array(
		$x,
		$gambar,
		$nama,
		$row['email'],
		$row['no_telp'],
		$actionButton
	);
	$x++;
}

}

// database connection close
$connect->close();

echo json_encode($output);
