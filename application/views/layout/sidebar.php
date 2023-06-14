<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
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
            <li>
                <a href="index.html">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
				</a>
			</li>


            <li>
              <a href="#">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>


            <!-- /.dari database -->

            <?
            	$user_id = $_SESSION["sess_user_id"];
			    $this->db->select('jo_menu.id, jo_menu.parent_id, jo_menu.title, jo_menu.url, jo_menu.menu_order, jo_menu.status, jo_menu.aktif, jo_menu.remark, jo_menu_detail.menu_id, jo_menu_detail.user_id');
				$this->db->from('jo_menu');
				$this->db->join('jo_menu_detail', 'jo_menu.id = jo_menu_detail.menu_id');
				$where = "jo_menu.status = 1 AND jo_menu.aktif = 1 AND jo_menu.aktif = 1 AND jo_menu.parent_id = 0 AND jo_menu_detail.user_id = '".$user_id."'";
				//$this->db->where(array('jo_menu.status = 1', 'jo_menu.aktif = 1', 'jo_menu.aktif = 1', 'jo_menu.parent_id = 0', 'jo_menu_detail.user_id' => $user_id));
				$this->db->where($where);
				$query = $this->db->get();
				//$hasil = $query->row();
				$result = $query->result(); 
		  foreach( $query->result() as $baris ){
				
          ?><li class=""><a href="#" class="dropdown-toggle">
          <? if ($baris->title == "Project") { ?>
              <i class="fa fa-files-o"></i><?=$baris->title?><?
          } else if ($baris->title == "Accounting") { ?>
              <i class="fa fa-book"></i> <?=$baris->title?><?
            } else if ($baris->title=="HRD") { ?>
                <i class="fa fa-th"></i> <?=$baris->title?><?
              } else if ($baris->title=="Utillity") { ?>
                  <i class="fa fa-laptop"></i> <?=$baris->title?><?
                } else if ($baris->title=="Inventory") { ?>
                    <i class="fa fa-edit"></i> <span><?=$baris->title?></span><?
                  } else if ($baris->title=="Calendar") { ?>
                      <i class="fa fa-calendar"></i> <span><?=$baris->title?></span><small class="label pull-right bg-red">1</small><?
                    }  else { ?>
                        <i class="fa fa-share"></i> <span><?=$baris->title?></span>
                      <? } ?>
          <i class="fa fa-angle-left pull-right"></i>
          </a><?

		?>

			<ul class="submenu">

			<?
			    $ibu1 = $baris->id;
          		$this->db->select('jo_menu.id, jo_menu.parent_id, jo_menu.title, jo_menu.url, jo_menu.menu_order, jo_menu.status, jo_menu.aktif, jo_menu.remark, jo_menu_detail.menu_id, jo_menu_detail.user_id');
				$this->db->from('jo_menu');
				$this->db->join('jo_menu_detail', 'jo_menu.id = jo_menu_detail.menu_id');
				$where1 = "jo_menu.status = 1 AND jo_menu.aktif = 1 AND jo_menu.aktif = 1 AND jo_menu.parent_id = '".$ibu1."' AND jo_menu_detail.user_id = '".$user_id."'";
				//$this->db->where(array('a.id' => 'b.menu_id', 'a.status' => '1', 'a.aktif' => '1', 'a.aktif' => '1', 'a.parent_id' => $ibu1, 'b.user_id' => $user_id));
				$this->db->where($where1);
				$this->db->order_by('jo_menu.id','ASC');
				$query2 = $this->db->get();
				//$hasil = $query->row();
				$result2 = $query2->result(); 
					foreach( $result2 as $barisa ){

                ?><li><a href="#" class="dropdown-toggle"><i class="fa fa-folder"></i> <?=$barisa->title?> <i class="fa fa-angle-left pull-right"></i></a><?

          ?>

					<ul class="submenu">

            <?
							
							//echo $SQLab; exit();
              	$ibu2 = $barisa->id;
          		$this->db->select('jo_menu.id, jo_menu.parent_id, jo_menu.title, jo_menu.url, jo_menu.menu_order, jo_menu.status, jo_menu.aktif, jo_menu.remark, jo_menu_detail.menu_id, jo_menu_detail.user_id');
				$this->db->from('jo_menu');
				$this->db->join('jo_menu_detail', 'jo_menu.id = jo_menu_detail.menu_id');
				$where2 = "jo_menu.status = 1 and jo_menu.aktif = 1 and jo_menu.aktif = 1 and jo_menu.parent_id = '".$ibu2."' and jo_menu_detail.user_id = '".$user_id."'";
				//$this->db->where(array('a.id' => 'b.menu_id', 'a.status' => '1', 'a.aktif' => '1', 'a.aktif' => '1', 'a.parent_id' => $ibu2, 'b.user_id' => $user_id));
				$this->db->where($where2);
				$query3 = $this->db->get();
				//$hasil = $query->row();
				$result3 = $query3->result(); 
				foreach( $result3 as $barisab ){
                    if ($barisab->title=='Data Project') {
                      ?><li><a href="<?=$barisab->url?>" class="dropdown-toggle"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                    } else if ($barisab->title=='Recapitulation Project') {
                        ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                      } else if ($barisab->title=='Detail Invoice') {
                        ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                        } else if ($barisab->title=='Project Planner') {
                          ?><li><a href="javascript:window.open('<?=$barisab->url?>', 'windowName', 'height=700,width=1000')"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                        } else if ($barisab->title=='Mobilization') {
                            ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                            } else if ($barisab->title=='Maintenance request') {
                              ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                              } else if ($barisab->title=='Site actvities') {
                                ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                } else if ($barisab->title=='Work Order') {
                                  ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                  } else if ($barisab->title=='Data Equipment') {
                                    ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                    } else if ($barisab->title=='Barang Persediaan') {
                                      ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                      } else if ($barisab->title=='Order Handling') {
                                        ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                        } else if ($barisab->title=='Thermint plant') {
                                          ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                          } else if ($barisab->title=='Payment Report') {
                                            ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                            } else if ($barisab->title=='Faktur Pajak List') {
                                              ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                              } else if ($barisab->title=='Aged Customers Analysis') {
                                                ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                } else if ($barisab->title=='Outstanding List') {
                                                  ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                  } else if ($barisab->title=='Project Prospecting') {
                                                    ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                    } else if ($barisab->title=='Billing PLan') {
                                                          ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                        } else if ($barisab->title=='Recapitulation Invoice / Job') {
                                                              ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i>   <?=$barisab->title?></a></li><?
                                                          } else if ($barisab->title=='Receiving Report') {
                                                              ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                            } else if ($barisab->title=='Asset') {
                                                                ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                              } else if ($barisab->title=='Maintenance Asset') {
                                                                  ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                } else if ($barisab->title=='Bincard stock') {
                                                                    ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                  } else if ($barisab->title=='Alat Lab') {
                                                                      ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                    } else if ($barisab->title=='Demobilization') {
                                                                        ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                      } else if ($barisab->title=='Intruksi Kerja LAB') {
                                                                          ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                        } else if ($barisab->title=='Pemeriksaan contoh masuk') {
                                                                            ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                          } else if ($barisab->title=='Produktivitas Teknisi Lab') {
                                                                              ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                            } else if ($barisab->title=='Mobilization Report') {
                                                                                ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                              } else if ($barisab->title=='object identification field') {
                                                                                  ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                } else if ($barisab->title=='Intruksi lab report') {
                                                                                    ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                  } else if ($barisab->title=='Outstanding History') {
                                                                                      ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                    } else if ($barisab->title=='Progress Lab Project') {
                                                                                        ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                      } else if ($barisab->title=='Progress Lab Technician') {
                                                                                          ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                        } else if ($barisab->title=='Transfers Stock') {
                                                                                            ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                          } else if ($barisab->title=='Data Test Lab') {
                                                                                              ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                            } else if ($barisab->title=='Group Price') {
                                                                                                ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                              } else if ($barisab->title=='Master Price') {
                                                                                                  ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                                } else if ($barisab->title=='Risk Project') {
                                                                                                    ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                                  } else if ($barisab->title=='Template Penawaran') {
                                                                                                      ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                                    } else if ($barisab->title=='Budget') {
                                                                                                        ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                                      } else if ($barisab->title=='Sample test') {
                                                                                                          ?><li><a href="<?=$barisab->url?>"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li><?
                                                                                                        } else  {
                                                                                                          ?><li><a href="javascript:window.open('<?=$barisab->url?>', '<?=$barisab->url?>', 'height=700,width=1100')"><i class="fa fa-circle-o"></i> <?=$barisab->title?></a></li>
                                                                                                          <? }

              }
             // end of child 2
            ?>
					</ul>
				</li>
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

			