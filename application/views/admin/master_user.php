<?
include "../include/otentik_admin.php"; include ("../include/functions.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">

	<title>DataTables example - Scroll - horizontal and vertical</title>
	<link rel="stylesheet" type="text/css" href="../datatable/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="../datatable/examples/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="../datatable/examples/resources/demo.css">
	<style type="text/css" class="init">

	th, td { white-space: nowrap; padding: 1px; }
	div.dataTables_wrapper {
		width: 100%;
		margin: 0 auto;
	}
  body {
    margin : 0px auto;
    background-color:#eee;
    font-family: "Segoe UI";
	  font-size: 11px;
  }
  table {
    border-spacing:1;
    border-collapse:collapse;
  }
	</style>
	<script type="text/javascript" language="javascript" src="../datatable/media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="../datatable/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="../datatable/examples/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="../datatable/examples/resources/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">
$(document).ready(function(){
 var blurred = false;
     window.onblur = function() { blurred = true; };
     window.onfocus = function() { blurred && (location.reload()); };
});
$(document).ready(function() {
  $('#example').dataTable( {
    "scrollY": 250,
    "scrollX": true
  } );
} );

  </script>
<script type="text/javascript">
function confirmDelete(delUrl) {
  if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
      document.location = delUrl;
    }
  }
</script>
<script src="../projectplan/js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
<script type="text/javascript">
                    function detailmenu(id, nama) {
                        var modal = new DayPilot.Modal();
                        modal.closed = function() {
                            dp.clearSelection();

                            // reload all events
                            var data = this.result;
                            if (data && data.result === "OK") {
                                loadEvents();
                            }
                        };
                        modal.zIndex = 1900;
                        modal.height = 370;
                        modal.width = 750;
                        modal.showUrl("index.php?mn=user_akses&id="+id+"&nama="+nama);

                    };
                    function detailuser(id) {
                        var modal = new DayPilot.Modal();
                        modal.closed = function() {
                            dp.clearSelection();

                            // reload all events
                            var data = this.result;
                            if (data && data.result === "OK") {
                                loadEvents();
                            }
                        };
                        modal.zIndex = 1900;
                        modal.height = 300;
                        modal.width = 500;
                        modal.showUrl("index.php?mn=user_form&id="+id);

                    };
                    function newuser() {
                        var modal = new DayPilot.Modal();
                        modal.closed = function() {
                            dp.clearSelection();

                            // reload all events
                            var data = this.result;
                            if (data && data.result === "OK") {
                                loadEvents();
                            }
                        };
                        modal.zIndex = 1900;
                        modal.height = 300;
                        modal.width = 500;
                        modal.showUrl("index.php?mn=user_form");

                    };

</script>
</head>

<body>
<?
echo '<table border="0" width="100%" cellpadding="0" cellspacing="0" style="position:fixed;padding: 3px; background-color:#004080; cursor:pointer; color:white;font-weight:bold; font-size:11px; outline-width: 0; border: 0px solid #000064; border-radius: 0px; -moz-border-radius: 0px; -moz-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.5); box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);">';
      echo '<tr>';
      echo '<td width="2%"><img src="../images/Users-folder-32.png" width="20" height="20" /></td>';
      echo '<td width="98%"><span style="color:#fff;font-weight:bold">MASTER USER</span><span style="color:#fff;font-style:italic"> ';
      echo '</span>';
      echo '</td></tr></table><br>';
?>
  <table width="100%" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="1%" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="5%" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="javascript:newuser();"><img src="../draft/images/user_addx.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="5%" rowspan="3" valign="bottom"></td>
	    <td width="5%" rowspan="3" valign="bottom"></td>
      <td width="5%" rowspan="3" valign="bottom"></td>
      <td width="5%" rowspan="3" valign="bottom"></td>
      <td width="5%" rowspan="3">&nbsp;</td>
      <td width="1%" rowspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="2%"><div align="center"><img src="../draft/images/calendar.png" width="16" height="16" /></div></td>
      <td width="2%"><div align="center">:</div></td>
      <td width="70%">&nbsp;
	  <? date_default_timezone_set('Asia/Jakarta'); echo date('l, j F Y'); ?></td>
      </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../draft/images/Gnome-Appointment-New-48.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left"> &nbsp;<?php echo gmdate(" H:i:s", time()+60*60*7); ?>  </div></td>
    </tr>
    <tr>
      <td class="style3"></td>
      <td class="style3"></td>
      <td class="style3"></td>
      <td class="style3"><div align="center" class="style5">New User</div></td>
      <td class="style3"></td>
      <td class="style3"><div align="center" class="style5"></div></td>
	  <td class="style3"><div align="center" class="style5"></div></td>
      <td class="style3" colspan="2"></td>
      <td><span class="style5"></span></td>
    </tr>
    <tr>
      <td colspan="10">&nbsp;</td>
    </tr>
  </table>
  <div class="container">
    <section>


      <table id="example" class="display" cellspacing="0" width="100%">
        <thead>

          <tr>
          <th>No.</th>
          <th>Username</th>
          <th>Nama</th>
          <th>Kelas User</th>
          <th>Divisi</th>
          <th>Status</th>
          <th>Menu</th>
          <th>Edit</th>
          <th>Hapus</th>
          </tr>
        </thead>

        <tbody>

          <?
          $query = mysql_query("SELECT id, user, pass, pass2, kelasuser, nama, status, aktif, tipe, kode_mp, nama_mp, nilai_uang, tanda_tangan FROM ml_user WHERE status = 1");

          $nRecord = 1;
          $hasil = mysql_num_rows($query);
          if ($hasil > 0)
          {
            while ($data = mysql_fetch_row($query))
            {?>
              <tr <?   if (($nRecord % 2)==0) {?>bgcolor="#FFFFCC"<? } else{ ?>bgcolor="#FFFFFF" <? } ?>>
              <td><?=++$no?>.</td>
              <td><?=$data[1]?></td>
              <td><?=$data[5]?></td>
              <td><?=$data[4]?></td>
              <td><?
                  $SQLc = "SELECT namadiv FROM divisi WHERE subdiv = '".$data[8]."'";
                  $hasilc = mysql_query($SQLc);
                  $barisc = mysql_fetch_array($hasilc);
                  echo $barisc[0];
                  ?>
              </td>
              <? if ($data[7]=="1"){?>
              <td>On</td>
              <? } else { ?>
              <td>Off</td>
              <? } ?>
              <? if ($data[0]=="1" || $data[0]=="2"){?>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <? }else { ?>
              <td><a href="javascript:detailmenu('<?=$data[0]?>','<?=$data[5]?>')"><img src="../images/icons/icon-key.png" alt="Edit" width="16" height="16" border="0" /></a></td>
              <td><a href="javascript:detailuser('<?=$data[0]?>')"><img src="../images/icons/edit2.gif" alt="Edit" border="0" /></a></td>
              <td><a href="javascript:confirmDelete('admin_submission.php?cmd=del_user&amp;id=<?=$data[0]?>')"><img src="../images/icons/hapus.gif" alt="Hapus" border="0" /></a></td>
              <? } ?>
              </tr>
              <?
              $nRecord = $nRecord + 1;
             }
          }
          ?>
        </tbody>
      </table>


</body>
</html>
