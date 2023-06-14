<?
session_start();
?>
<?
include "../include/otentik_admin.php";
include ("../include/functions.php");?>
<style type="text/css">

</style>
<style type="text/css">
* { font: 10px/12px Verdana, sans-serif; }
h4 { font-size: 10px; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 1px; }
input.kanan{ text-align:right; }
</style>
<script type="text/javascript" src="../assets/jquery.js"></script>
<script type="text/javascript" src="../payrollx/notifikasi.js"></script>
<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
 <script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />

  <?
	if (isset($_GET['input']))
	{
		$input = $_GET['input'];

		$query = mysql_query("SELECT nama, kode, jabatan FROM tmkaryawan WHERE status = 'aktif' and (nama LIKE '%$input%' or jabatan LIKE '%$input%') order by nama ASC"); //query mencari hasil search
		$hasil = mysql_num_rows($query);
		if ($hasil > 0)
		{
      echo "<table border=0>";
			while ($data = mysql_fetch_row($query))
			{
				?>
        <tr bgcolor="#FFF"><td onMouseover="this.bgColor='yellow'" onMouseout="this.bgColor=''">
				<a style="color:#000064; font-weight:bold" href="javascript:autoInsertKaryawanx('<?=$data[0]?>','<?=$data[1]?>','<?=$data[2]?>');"><?=$data[1]?>&nbsp;<?=$data[0]?>&nbsp;<?=$data[2]?></td></tr><?
			}
      echo "</table>";
		}
		else
		{
			echo "Data tidak ditemukan";
		}

	}


?>