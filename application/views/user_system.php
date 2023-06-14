<div class="main-content">
<div class="main-content-inner">

<script type="text/javascript">
function confirmDelete(delUrl) {
  if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
      document.location = delUrl;
    }
  }
</script>

<script src="<?php echo base_url();?>projectplan/js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
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
                        modal.showUrl("<?php echo base_url();?>admin/index.php?mn=user_akses&id="+id+"&nama="+nama);

                    };
                    function detailuser(id) {
                        var modal = new DayPilot.Modal({
                          onClosed: function(args) {
                          console.log("Modal dialog closed");
                          },
                          onShow: function(args) {
                            backgroundClick = false;
                            preventDefault();
                          },
                          // ...
                        });
                        modal.zIndex = 1900;
                        modal.height = 300;
                        modal.width = 500;
                        modal.showUrl("<?php echo base_url();?>admin/index.php?mn=user_form&id="+id);

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
                        modal.showUrl("<?php echo base_url();?>admin/index.php?mn=user_form");

                    };

</script>

<table width="100%" border="0" cellspacing="1">
    <tr>
      <td width="1%" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="5%" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="javascript:newuser();"><img src="<?php echo base_url();?>draft/images/user_addx.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="5%" rowspan="3" valign="bottom"></td>
	    <td width="5%" rowspan="3" valign="bottom"></td>
      <td width="5%" rowspan="3" valign="bottom"></td>
      <td width="5%" rowspan="3" valign="bottom"></td>
      <td width="5%" rowspan="3">&nbsp;</td>
      <td width="1%" rowspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="2%"><div align="center"><img src="<?php echo base_url();?>draft/images/calendar.png" width="16" height="16" /></div></td>
      <td width="2%"><div align="center">:</div></td>
      <td width="70%">&nbsp;
	  <? date_default_timezone_set('Asia/Jakarta'); echo date('l, j F Y'); ?></td>
      </tr>
    <tr>
      <td class="style3"><div align="center"><img src="<?php echo base_url();?>draft/images/Gnome-Appointment-New-48.png" width="16" height="16" /></div></td>
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
</div>

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
          $this->db->select('id, user, pass, pass2, kelasuser, nama, status, aktif, tipe, kode_mp, nama_mp, nilai_uang, tanda_tangan');
          $this->db->from('ml_user');
          $where = "status = 1";
          $this->db->where($where);
          $query = $this->db->get();
        //$hasil = $query->row();
          $result = $query->result(); 
          
          $no = 1;
            foreach( $query->result() as $data )
            {
              ?>
              <tr>
              <td><?php echo $no++;?></td>
              <td><?=$data->user;?></td>
              <td><?=$data->nama;?></td>
              <td><?=$data->kelasuser;?></td>
              <td><?
                  
                  ?>
              </td>
              <? if ($data->aktif == "1"){?>
              <td>On</td>
              <? } else if ($data->aktif != "1") { ?>
              <td>Off</td>
              <? } ?>
              <? if ($data->id=="1" || $data->id=="2"){?>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <? }else { ?>
              <td><a href="javascript:detailmenu('<?=$data->id;?>','<?=$data->nama;?>')"><img src="<?php echo base_url();?>images/icons/icon-key.png" alt="Edit" width="16" height="16" border="0" /></a></td>
              <td><a href="javascript:detailuser('<?=$data->id;?>')"><img src="<?php echo base_url();?>images/icons/edit2.gif" alt="Edit" border="0" /></a></td>
              <td><a href="javascript:confirmDelete('<?php echo base_url();?>admin/admin_submission.php?cmd=del_user&amp;id=<?=$data->id;?>')"><img src="<?php echo base_url();?>images/icons/hapus.gif" alt="Hapus" border="0" /></a></td>
              <? } ?>
              </tr>
              <?
             }
          
          ?>
        </tbody>
      </table>
</div>