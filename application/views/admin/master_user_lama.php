<script language="JavaScript">
<!--
  function confirmDelete(delUrl) {
    if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
      document.location = delUrl;
    }
  }
//-->
</script>
<? include "../include/otentik_admin.php";

  $SQL = "SELECT * FROM ml_user WHERE status = 1";
  if(isset($_GET['id'])){
    $SQL = $SQL." AND id = ".$_GET['id'];
  }

  $hasil=mysql_query($SQL, $dbh1);

?>
<style type="text/css">
<!--
body {
  background-color: #f7f7f7;
    background-image: -moz-linear-gradient(top, #f0f0f0, #f9f9f9);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f0f0f0), to(#f9f9f9));
    background-image: -webkit-linear-gradient(top, #f0f0f0, #f9f9f9);
    background-image: -o-linear-gradient(top, #f0f0f0, #f9f9f9);
    background-image: linear-gradient(to bottom, #f0f0f0, #f9f9f9);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff0f0f0', endColorstr='#fff9f9f9', GradientType=0);
}
.style7 {
  font-family: "Segoe UI";
  font-size: 12px;
}
.style12 {
  font-family: "Segoe UI";
  font-size: 12px;
  font-weight: bold;
  color: #0000FF;
}
.style13 {
  color: #FFFFFF;
  font-weight: bold;
}
table {
  border-spacing:-1;
  border-collapse:collapse;
}
-->
</style>
    <style type="text/css">
* { font: 10px/12px Verdana, sans-serif; }
h4 { font-size: 10px; }
input { padding: 3px; border: 1px solid #999; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 1px; }
</style>

<table width="100%" border="0">
  <tr>
    <td width="37"><img src="../images/Users-folder-32.png" width="32" height="32" /></td>
    <td width="1093"><span class="style12">HAK AKSES USER
      </span>
    <hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="1" align="left" cellpadding="3" cellspacing="1" bgcolor="#000000">
      <tr bgcolor="#DDDDDD">
        <td colspan="10" align="center" bgcolor="#0000FF" class="style7"><span class="style13">MASTER USER</span></td>
      </tr>
      <tr bgcolor="#DDDDDD">
        <td bgcolor="#CCCC66" class="style7"><div align="center">
            <div align="center">No.</div>
        </div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Username</div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Nama</div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Kelas User</div></td>
    <td bgcolor="#CCCC66" class="style7"><div align="center">Divisi</div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Status</div></td>
    <td bgcolor="#CCCC66" class="style7"><div align="center">Menu</div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Edit</div></td>
        <td bgcolor="#CCCC66" class="style7"><div align="center">Hapus</div></td>
      </tr>
      <? $nRecord = 1; while ($row=mysql_fetch_array($hasil)) { ?>
      <tr <?   if (($nRecord % 2)==0) {?>bgcolor="#FFFFCC"<? } else{ ?>bgcolor="#FFFFFF" <? } ?>>
        <td class="style7"><div align="center">
            <?=++$no?>
          .</div></td>
        <td class="style7"><?=$row['user']?>
        </td>
        <td class="style7"><?=$row['nama']?>
        </td>
        <td class="style7"><?=$row['kelasuser']?>
        </td>
    <td align="center" class="style7">
      <?
        $SQLc = "SELECT namadiv FROM divisi WHERE subdiv = '".$row['tipe']."'";
        $hasilc = mysql_query($SQLc);
        $barisc = mysql_fetch_array($hasilc);
        echo $barisc[0];
      ?>
    </td>
        <? if ($row['aktif']=="1"){?>
        <td align="center" class="style7">On</td>
        <? } else { ?>
        <td align="center" class="style7">Off</td>
        <? } ?>

        <? if ($row['id']=="1" || $row['id']=="2"){?>
        <td class="style7">&nbsp;</td>
        <td class="style7">&nbsp;</td>
    <td class="style7">&nbsp;</td>
        <? }else { ?>
    <td align="center" class="style7"><a href="index.php?mn=user_akses&amp;id=<?=$row["id"]?>&nama=<?=$row['nama']?>"><img src="../images/icons/icon-key.png" alt="Edit" width="16" height="16" border="0" /></a></td>
        <td align="center" class="style7"><a href="index.php?mn=user_form&amp;id=<?=$row["id"]?>"><img src="../images/icons/edit2.gif" alt="Edit" border="0" /></a></td>
        <td align="center" class="style7"><a href="javascript:confirmDelete('admin_submission.php?cmd=del_user&amp;id=<?=$row["id"]?>')"><img src="../images/icons/hapus.gif" alt="Hapus" border="0" /></a></a></td>
        <? } ?>
      </tr>
      <? $nRecord = $nRecord + 1; } ?>
      <tr bgcolor="white">
        <td colspan="10" align="center" class="style7"><a href="index.php?mn=user_form">Tambah User</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<span class="style7"><br>
</span>