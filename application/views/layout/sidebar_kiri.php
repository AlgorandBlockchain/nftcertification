<div id="sidebar" class="sidebar sidebar-fixed menu-min                  responsive                    ace-save-state">
	<?
	$user_id = $_SESSION["sess_user_id"];
	$sqlheader = "SELECT * FROM mymenu where url_erp = '".$view_isi."'";
	$sqlheader = $this->db->query($sqlheader);
	$parent_id3 = "";$parent_id2 = "";$url_erp2 = "";
	if ($sqlheader->num_rows()>0) {
		foreach($sqlheader->result() as $datah) {
			$parent_id3 = $datah->parent_id;
		}
		$sqlheader1 = "SELECT * FROM mymenu where id = '".$parent_id3."'";
		$sqlheader1 = $this->db->query($sqlheader1);
		if ($sqlheader1->num_rows()>0) {
			foreach ($sqlheader1->result() as $dataheader1) {
				$parent_id2 = $dataheader1->id;
				$url_erp2 = $dataheader1->url_erp;
			}
		}
	}
	?>
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>
				<script src="<?php echo base_url();?>projectplan/js/daypilot/daypilot-modal-2.7.js" type="text/javascript"></script>
				<script type="text/javascript">
				function alamatweb(url) {
						var modal = new DayPilot.Modal({backdrop: 'static', keyboard: false});
						modal.onClose = function(args) {
								if (args.backgroundClick) {
										args.preventDefault();
								}
						};
						modal.zIndex = 1900;
						modal.height = 500;
						modal.width = 1180;
						modal.showUrl("<?php echo base_url();?>"+url);

				};
				</script>
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
            <? if ($view_isi=='dasboard' || $view_isi=='view_home') { ?><li class="active"><? } else { ?><li><? } ?>
                <a href="<?php echo base_url();?>index.php/home/dasboard">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Beranda </span>
						</a>
					</li>
					<? if ($view_isi=='profile' || $view_isi=='Profile') { ?><li class="active"><? } else { ?><li><? } ?>
							<a href="<?php echo base_url();?>index.php/home/profile">
						<i class="menu-icon fa fa fa-user"></i>
						<span class="menu-text"> Profile </span>
					</a>
				</li>




						<!-- /.dari database -->

            <?
        $user_id = $_SESSION["sess_user_id"];
				$this->db->select('mymenu.id, mymenu.parent_id, mymenu.title, mymenu.url, mymenu.menu_order, mymenu.status, mymenu.aktif, mymenu.remark, mymenu.url_erp');
				$this->db->from('mymenu');
				$where = "mymenu.status = 1 AND mymenu.aktif = 1 AND mymenu.aktif = 1 AND mymenu.parent_id = 0 AND mymenu.title <> 'Profile'";
				//$this->db->where(array('jo_menu.status = 1', 'jo_menu.aktif = 1', 'jo_menu.aktif = 1', 'jo_menu.parent_id = 0', 'jo_menu_detail.user_id' => $user_id));
				$this->db->where($where);
				$query = $this->db->get();
				//$hasil = $query->row();
				$result = $query->result();
		  foreach( $query->result() as $baris ){
					if ($parent_id2==$baris->id) { ?><li class="active open"><? } else {?><li class=""><?}
          ?>
          <? if ($baris->title=="Education") { ?>
                <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-list-alt"></i><span class="menu-text"><?=$baris->title?></span>
								<b class="arrow fa fa-angle-down"></b></a>
								<?
              } else if ($baris->title=="Expertise") { ?>
                  <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-pencil-square-o"></i><span class="menu-text"><?=$baris->title?></span>
									<b class="arrow fa fa-angle-down"></b></a>
									<?
                } else { ?>
                    <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-share"></i><span class="menu-text"><?=$baris->title?></span></a>
                  <? } ?>
					<?

		?>

			<ul class="submenu">

			<?
			  $ibu1 = $baris->id;
				$this->db->select('mymenu.id, mymenu.parent_id, mymenu.title, mymenu.url, mymenu.menu_order, mymenu.status, mymenu.aktif, mymenu.remark, mymenu.url_erp');
				$this->db->from('mymenu');
				$where1 = "mymenu.status = 1 AND mymenu.aktif = 1 AND mymenu.aktif = 1 AND mymenu.parent_id = '".$ibu1."'";
				//$this->db->where(array('a.id' => 'b.menu_id', 'a.status' => '1', 'a.aktif' => '1', 'a.aktif' => '1', 'a.parent_id' => $ibu1, 'b.user_id' => $user_id));
				$this->db->where($where1);
				$this->db->order_by('mymenu.id','ASC');
				$query2 = $this->db->get();
				//$hasil = $query->row();
				$result2 = $query2->result();
					foreach( $result2 as $barisa ){
						if ($view_isi==$barisa->url_erp) { ?><li class="active"><? } else { ?><li><? }
						if (($barisa->url_erp != '')||($barisa->url_erp != null)) {
							?><a href="<?php echo base_url();?>index.php/home/<?=$barisa->url_erp?>"><i class="fa fa-circle-o"></i> <?=$barisa->title?></a><?
						} else {
								?><a href="javascript:alamatweb('<?=$barisa->url?>')"><i class="fa fa-circle-o"></i> <?=$barisa->title?></a><?
							}
							?></li>
				<? } // end of child 1
        ?>
			</ul>
		</li>
		<? } //end of parent_id = 0
    ?>

            <!-- /.end of fari database -->

          </ul><!-- /.nav-list -->

					<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
						<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
					</div>
				</div>
