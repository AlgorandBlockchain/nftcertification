<?
session_start();
include ("../include/globalx.php");
include ("../include/otentik_admin.php");

$cmd = $_POST['cmd'];
if ($cmd==""){
	$cmd = $_GET['cmd'];
}

		date_default_timezone_set('Asia/Shanghai');
		$wkt_disimpan = Date("Y-m-d H:i:s");
		$xbulan = $_REQUEST['slBulan'];
		$xtanggal = $_REQUEST['slTanggal'];
		$TanggalLahir=$_REQUEST['slTahun']."-".$xbulan."-".$xtanggal." 00:00:00";

switch ($cmd) {
	case "add_user" :
	if ($_POST['wewenangpr1']=="") {$wewenangpr1 = "no";} else {$wewenangpr1 = "yes";}
	if ($_POST['wewenangpr2']=="") {$wewenangpr2 = "no";} else {$wewenangpr2 = "yes";}
	if ($_POST['pembuatpo']=="") {$pembuatpo = "no";} else {$pembuatpo = "yes";}
	if ($_POST['pembuatspj']=="") {$pembuatspj = "no";} else {$pembuatspj = "yes";}
	if ($_POST['admin_koperasi']=="") {$admin_koperasi = "no";} else {$admin_koperasi = "yes";}
	if ($_POST['void_po']=="") {$void_po = 0;} else {$void_po = 1;}
	if ($_POST['admin_lab']=="") {$admin_lab = "tidak";} else {$admin_lab = "ya";}
	if ($_POST['admin_receiving']=="") {$admin_receiving = "tidak";} else {$admin_receiving = "ya";}
    $sqlmpx = mysql_query("select max(id) as maxid from ml_user");
    if (mysql_num_rows($sqlmpx)>0) {$datampx = mysql_fetch_array($sqlmpx);$no_urut = $datampx[0] + 1;} else {$no_urut = 1;}
    $SQLmp = "SELECT nama FROM tmkaryawan WHERE kode = '".$_POST['kode_mp']."'";
		$hasilmp = mysql_query($SQLmp);
		$barismp = mysql_fetch_array($hasilmp);
    $nama_mp = $barismp[0];
		$SQL = "INSERT INTO ml_user(id, user, pass, pass2, kelasuser, nama, status, aktif, tipe, kode_mp, nama_mp, nilai_uang, tanda_tangan, wewenangpr1, wewenangpr2, pembuatpo, pembuatspj, admin_koperasi, void_po, admin_lab, admin_receiving) VALUES('".$no_urut."', '".$_POST['username']."', md5('".$_POST['password']."'), '".$_POST['password']."', '".$_POST['slKelas']."', '".$_POST['nama']."', 1, ".$_POST['status'].",
            '03','".$_POST['kode_mp']."','".$nama_mp."','".$_POST['nilai_uang']."','".$_POST['tanda_tangan']."', '".$wewenangpr1."', '".$wewenangpr2."', '".$pembuatpo."', '".$pembuatspj."', '".$admin_koperasi."', '".$void_po."', '".$admin_lab."', '".$admin_receiving."')";
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=user_form&id=".$no_urut;
	break;
	case "upd_user" :
	if ($_POST['wewenangpr1']=="") {$wewenangpr1 = "no";} else {$wewenangpr1 = "yes";}
	if ($_POST['wewenangpr2']=="") {$wewenangpr2 = "no";} else {$wewenangpr2 = "yes";}
	if ($_POST['pembuatpo']=="") {$pembuatpo = "no";} else {$pembuatpo = "yes";}
	if ($_POST['pembuatspj']=="") {$pembuatspj = "no";} else {$pembuatspj = "yes";}
	if ($_POST['admin_koperasi']=="") {$admin_koperasi = "no";} else {$admin_koperasi = "yes";}
	if ($_POST['void_po']=="") {$void_po = 0;} else {$void_po = 1;}
	if ($_POST['admin_lab']=="") {$admin_lab = "tidak";} else {$admin_lab = "ya";}
	if ($_POST['admin_receiving']=="") {$admin_receiving = "tidak";} else {$admin_receiving = "ya";}
    $SQLmp = "SELECT nama FROM tmkaryawan WHERE kode = '".$_POST['kode_mp']."'";
		$hasilmp = mysql_query($SQLmp);
		$barismp = mysql_fetch_array($hasilmp);
    $nama_mp = $barismp[0];
		$SQL = "UPDATE ml_user SET user = '".$_POST['username']."', pass = md5('".$_POST['password']."'),
            pass2 = '".$_POST['password']."', kelasuser = '".$_POST['slKelas']."', nama = '".$_POST['nama']."',
            aktif = ".$_POST['status'].",
            tipe = '03', kode_mp = '".$_POST['kode_mp']."',
            nama_mp = '".$nama_mp."', nilai_uang = '".$_POST['nilai_uang']."', tanda_tangan = '".$_POST['tanda_tangan']."',
            wewenangpr1 = '".$wewenangpr1."', wewenangpr2 = '".$wewenangpr2."', pembuatpo = '".$pembuatpo."', pembuatspj = '".$pembuatspj."', admin_koperasi = '".$admin_koperasi."',
						void_po = '".$void_po."', admin_lab = '".$admin_lab."', admin_receiving = '".$admin_receiving."' WHERE id = ".$_POST['id'];
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=user_form&id=".$_POST['id'];
	break;
	case "del_user" :
		$SQL = "DELETE FROM ml_user WHERE id = ".$_GET['id'];
		$hasil=mysql_query($SQL);
		//$strurl = "index.php?mn=user";
		//$strurl = "index.php/home/user_system";
		?>
		<script>
		history.go(-1);
		</script>
		<?
	break;
	case "upd_menu" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQLc = "SELECT * FROM jo_menu_detail WHERE user_id = '".$_POST['user_id']."' AND menu_id = '".$id[$i]."'";
			$hasilc = mysql_query($SQLc);
			if (mysql_num_rows($hasilc)==0) {
				$SQL = "INSERT INTO jo_menu_detail(id, user_id, menu_id) VALUES ('', '".$_POST['user_id']."', '".$id[$i]."')";
				$hasil = mysql_query($SQL);
			}
		}
		$strurl = "index.php?mn=user_akses&id=".$_POST['user_id']."&nama=".$_POST['nama'];
	break;
	case "del_menu" :
		$SQL = "DELETE from jo_menu_detail WHERE user_id = '".$_GET['user_id']."' AND menu_id = '".$_GET['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=user_akses&id=".$_GET['user_id']."&nama=".$_GET['nama'];
	break;
	case "add_master_menu" :
		$SQL = "INSERT INTO jo_menu(id, parent_id, title, url, menu_order, status, aktif) VALUES('', '".$_POST['parent']."', '".$_POST['nama']."', '".$_POST['link']."', 0, 1, 1)";
		$hasil = mysql_query($SQL);
		$strurl = "menu_popup.php";
	break;
	case "del_master_menu" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQLc = "UPDATE jo_menu SET status = 0 WHERE id = '".$id[$i]."'";
			$hasilc = mysql_query($SQLc);
		}
		$strurl = "index.php?mn=menu";
	break;
	case "upd_master_menu" :
		$SQL = "UPDATE jo_menu SET parent_id = '".$_POST['parent']."', title =  '".$_POST['nama']."', url = '".$_POST['link']."' WHERE id = '".$_POST['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=menu&id=".$_POST['id'];
	break;

}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd;
header("location: ".$strurl);
?>
