<head>
<?
	if (!isset($_SESSION['is_login'])) { exit; }
	include "../include/otentik_admin.php";

	if($_GET['id']<>""){
		$SQL = "SELECT * FROM ml_user WHERE status = 1 AND id = ".$_GET['id'];
		$hasil = mysql_query($SQL, $dbh1);
		while($row=mysql_fetch_array($hasil)) {
			$id = $row['id'];
			$user = $row['user'];
			$nama = $row['nama'];
			$kelasuser = $row['kelasuser'];
			$aktif = $row['aktif'];
			$password = $row['pass2'];
			$tipe = $row['tipe'];
      		$kode_mp = $row['kode_mp'];
      		$nama_mp = $row['nama_mp'];
      		$nilai_uang = $row['nilai_uang'];
      		$tanda_tangan = $row['tanda_tangan'];
      		$wewenangpr1 = $row['wewenangpr1'];
      		$wewenangpr2 = $row['wewenangpr2'];
      		$pembuatpo = $row['pembuatpo'];
      		$pembuatspj = $row['pembuatspj'];
					$admin_koperasi = $row['admin_koperasi'];
					$void_po = $row['void_po'];
					$admin_lab = $row['admin_lab'];
					$admin_receiving = $row['admin_receiving'];
      $SQlkar = "select * from tmkaryawan where kode = '".$kode_mp."'";
      $hasilkar = mysql_query($SQlkar);
      if ($hasilkar) {
        $datakar = mysql_fetch_array($hasilkar);
        $namakar = $datakar['nama'];$jabatankar = $datakar['jabatan'];$kode_mp = $datakar['kode'];
      } else {$namakar = $nama;$jabatan = '-';}
		}
	}
?>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.validate.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>payrollx/notifikasi.js"></script>
 <script language="javascript" src="<?php echo base_url();?>assets/thickbox/thickbox.js"></script>
<link type="text/css" href="<?php echo base_url();?>jqueryui7/themes/base/ui.all.css" rel="stylesheet" />
  <script type="text/javascript" src="<?php echo base_url();?>assets/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>jqueryui7/ui/ui.core.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>jqueryui7/ui/ui.tabs.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>jqueryui7/ui/ui.resizable.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>jqueryui7/ui/ui.accordion.js"></script>
  <link type="text/css" href="<?php echo base_url();?>jqueryui7/demos.css" rel="stylesheet" />

  <script>
  $(function() {
    $( "#tabs" ).tabs({
      collapsible: true
		});
	});
  $(function() {
		$("#accordion").accordion({
			fillSpace: true
		});
	});
	$(function() {
		$("#accordionResizer").resizable({
			resize: function() {
				$("#accordion").accordion("resize");
			},
			minHeight: 170
		});
	});
	</script>

 <script src="<?php echo base_url();?>projectplan/js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {

<? if($_GET['id']==""){ ?>
    $("#username").val('');
	$("#password").val('');
	$("#password_again").val('');
<? } ?>

	$("#userForm").validate({
		rules: {
			password: "required",
			password_again: {
		equalTo: "#password"
			}
		},
		messages: {
			email: {
				required: "E-mail harus diisi",
				email: "Masukkan E-mail yang valid"
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
})
</script>
<script type="text/javascript">
              function close(result) {
                  if (parent && parent.DayPilot && parent.DayPilot.ModalStatic) {
                    parent.DayPilot.ModalStatic.close(result);
                  }
                }


</script>
<style type="text/css">
body {
	background-color: #eee;
}
* { font: 10px/12px Verdana, sans-serif; }
h4 { font-size: 10px; }
input { padding: 3px; border: 1px solid #999; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 1px; }
.checkboxes label {
    display: block;
    float: left;
    padding-right: 12px;
    white-space: nowrap;
    font: 10px/10px Verdana, sans-serif;
}
.checkboxes input {
    vertical-align: middle;
}
.checkboxes label span {
    vertical-align: middle;
}
</style>
</head>
<body>
<div id="tabs" style="width:100%;overflow:auto">
<ul>
		<li><a href="#tabs-1">User Info</a></li>
		<li><a href="#tabs-2">Authority</a></li>
</ul>
<div id="tabs-1" style="background-color:#E8E8E8;height:250px;max-height:250px;overflow:auto">
<br>
<form id="userForm" method="post" action="admin_submission.php">
<? if($_GET['id']<>""){ ?>
<input type="hidden" name="cmd" value="upd_user">
<input type="hidden" name="id" value="<?=$id?>" />
<? } else { ?>
<input type="hidden" name="cmd" value="add_user">
<? } ?>
<table width="100%" border="0"><tr><td width="100%" align="center" valign="center">
<table valign="center" align="center">
	<tr>
		<td>Username</td>
		<td>:</td>
		<td><input type="text" id="username" name="username"  class="required"  title="Username harus diisi" value="<?=$user?>"/></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="password" id="password" name="password"  class="required"  title="Password harus diisi" value="<?=$password?>"/>		</td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td>:</td>
		<td><input type="password" name="password_again" id="password_again"   class="required"  title="isikan Password yg sama di atas" value="<?=$password?>" /></td>
	</tr>
  <tr>
    <td valign="top">Employee</td><td valign="top">:</td>
        <td><input type="text" autocomplete="off" name="nama_crew" id="nama_crew" class="required" onkeyup='autokaryawanx();' size="50" title="*" value="<?=$namakar;?> <?=$jabatankar;?>">
              <input type="hidden" class="required" name="kode_mp" id="kode_mp" value="<?=$kode_mp;?>">
              <div style=\"position: relative; width:225px; background-color: #ffffff; z-index:2000;border: 0px solid #A6A6A6;border-radius: 0px; -moz-border-radius: 0px; -webkit-box-shadow: 0 2px 3px rgba(0, 0, 0, 0.5); -moz-box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.5); box-shadow: 0 2px 3px rgba(0, 0, 0, 0.5);max-height:150px;overflow:auto;\" id="hasil"></div>
          </td>
  </tr>
	<tr>
		<td>Name</td>
		<td>:</td>
		<td><input type="text" name="nama" id="nama"  class="required"  title="Nama harus diisi" value="<?=$nama?>"/></td>
	</tr>
	<tr>
		<td>Level User</td>
		<td>:</td>
		<td><select name="slKelas" class="required"  title="Tipe Login harus diisi">
          <option value="">- Pilih Tipe Login -</option>
          <option value="User" <? if($kelasuser=="User") { ?>selected="selected" <? } ?>>User</option>
		  <option value="Admin" <? if($kelasuser=="Admin") { ?>selected="selected" <? } ?>>Admin</option>
		  <option value="Super Admin" <? if($kelasuser=="Super Admin") { ?>selected="selected" <? } ?>>Super Admin</option>
        </select></td>
	</tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td><input type="radio" name="status" value="1" <? if ($aktif == "1") {?> checked="checked" <? } ?>  class="required" title="Pilih On atau Off">On &nbsp;&nbsp;<input type="radio" name="status" value="0" <? if ($aktif == "0") {?> checked="checked" <? } ?>  class="required"  title="Pilih On atau Off">Off</td>
	</tr>
  <tr>
		<td>Currency Number</td>
		<td>:</td>
		<td><input type="radio" name="nilai_uang" value="1" <? if ($nilai_uang == "1") {?> checked="checked" <? } ?>  class="required" title="Pilih On atau Off">On &nbsp;&nbsp;<input type="radio" name="nilai_uang" value="0" <? if ($nilai_uang == "0") {?> checked="checked" <? } ?>  class="required"  title="Pilih On atau Off">Off</td>
	</tr><tr>
  <tr>
		<td>Signature</td>
		<td>:</td>
		<td><input type="radio" name="tanda_tangan" value="1" <? if ($tanda_tangan == "1") {?> checked="checked" <? } ?>  class="required" title="Pilih On atau Off">On &nbsp;&nbsp;<input type="radio" name="tanda_tangan" value="0" <? if ($tanda_tangan == "0") {?> checked="checked" <? } ?>  class="required"  title="Pilih On atau Off">Off</td>
	</tr>
</table>
</td></tr></table>

</div>
<div id="tabs-2" style="background-color:#E8E8E8;height:250px;max-height:250px;overflow:auto">
<span style="font-weight:bold;font-size:15">The competent authority to approve and decision maker</span>
<div class="checkboxes"><label>
<input type="checkbox" id="wewenangpr1" name="wewenangpr1" <? if ($wewenangpr1=="yes") { ?> checked="checked" <? } ?> > Approve purchase request level 1<br>
<input type="checkbox" id="wewenangpr2" name="wewenangpr2" <? if ($wewenangpr2=="yes") { ?> checked="checked" <? } ?> > Approve purchase request level 2<br>
<input type="checkbox" id="pembuatpo" name="pembuatpo" <? if ($pembuatpo=="yes") { ?> checked="checked" <? } ?> > Purchase order maker<br>
<input type="checkbox" id="pembuatspj" name="pembuatspj" <? if ($pembuatspj=="yes") { ?> checked="checked" <? } ?> > SPJ maker<br>
<input type="checkbox" id="admin_koperasi" name="admin_koperasi" <? if ($admin_koperasi=="yes") { ?> checked="checked" <? } ?> > Admin koperasi<br>
<input type="checkbox" id="void_po" name="void_po" <? if ($void_po==1) { ?> checked="checked" <? } ?> > Void Purchase Order<br>
<input type="checkbox" id="admin_lab" name="admin_lab" <? if ($admin_lab=='ya') { ?> checked="checked" <? } ?> > Admin Laboratory<br>
<input type="checkbox" id="admin_receiving" name="admin_receiving" <? if ($admin_receiving=='ya') { ?> checked="checked" <? } ?> > Admin Receiving
</label></div><br>
</div>
</div>
<table width="100%">
<tr>
		<td width="100%" align="center">
			<? if($_GET['id']<>""){ ?>
			<input type="submit" value="Update">
			<? } else { ?>
			<input type="submit" value="Save">
			<? } ?>
			<a href="javascript:close();">Close</a>		</td>
	</tr>
</table>
</form>
</body>
