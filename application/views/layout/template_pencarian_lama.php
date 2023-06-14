<?php

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title . ' - ' . $subtitle;?></title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
    	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-colorpicker.min.css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />


		<!-- dari datatable hide show -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/media/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/resources/syntax/shCore.css">
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/css/dataTables.colVis.css">

    	<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>
    	<script type="text/javascript" src="<?php echo base_url();?>payrollx/ajax_kota.js"></script>
    	<script type="text/javascript" src="<?php echo base_url();?>payrollx/notifikasi.js"></script>


		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->

  	<style type="text/css">
    .main-content{
    	margin: 20px;
    }
	</style>
	</head>

	<body class="skin-2">
		<?php $this->load->view('layout/header_kiri');?>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<?php $this->load->view('layout/sidebar_kiri');?>

			<?php $this->load->view($view_isi);?><!-- /.main-content -->

      <div id="right-menu" class="modal aside" data-body-scroll="false" data-offset="true" data-placement="right" data-fixed="true" data-backdrop="false" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header no-padding">
												<div class="table-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														<span class="white">&times;</span>
													</button>
													Kategori Pencarian
												</div>
											</div>

											<div class="modal-body">
                    <form method="post">
                        <div class="form-group"> <!--/here teh addclass has-error will appear -->
                			    Keahlian yang dicari
                			    <div>
                			      <input type="text" class="form-control" id="skill" name="skill" placeholder="Nama keahlian" autocomplete="off" onkeyup="autokeahlian(this.value);" value="<?=$skill?>">
									<div style="border:0px solid grey; width:100%; background-color:#FFF; display:block; max-height:200px; z-index:9991; solid #A6A6A6;overflow:auto;" id="hasilx"></div>
                			    </div>
                			  </div>
                        <div class="form-group">
                          Jenis kelamin

                          <div>
                            <label class="inline">
                              <input name="gender" id="gender" type="radio" <? if ($genre=="Male") { echo "checked"; } ?> class="ace" value="Male"/>
                              <span class="lbl middle"><small>Laki-laki</small></span>
                            </label>

                            &nbsp;
                            <label class="inline">
                              <input name="gender" id="gender" type="radio" <? if ($genre=="Female") { echo "checked"; } ?> class="ace" value="Female"/>
                              <span class="lbl middle"><small>Perempuan</small></span>
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                          Provinsi
                          <div>
                            <select class="form-control" name="prop" id="prop" onchange="ajaxkota(this.value)" data-placeholder="pilih provinsi...">
                              <option value="">Pilih provinsi</option>
                              <?php
                                 //
                                 $queryx = "SELECT * FROM inf_lokasi where lokasi_kabupatenkota=0 and lokasi_kecamatan=0 and lokasi_kelurahan=0 order by lokasi_nama";
                                 $queryx = $this->db->query($queryx);
                                 if ($queryx->num_rows()>0) {
                                   foreach($queryx->result() as $dataProvinsi) {
                                     ?><option value="<?=$dataProvinsi->lokasi_propinsi?>" <? if ($provinsi==$dataProvinsi->lokasi_propinsi) { ?>selected="selected"<? } ?>><?=$dataProvinsi->lokasi_nama?></option><?
                                   }
                                 }
                              ?>
                            <select>
                          </div>
                        </div>
                        <div class="form-group">
                          Kota / kabupaten
                          <div>
                            <select class="form-control"  name="kota" id="kota" onchange="ajaxkec(this.value)" data-placeholder="Choose a city...">
                              <option value=""></option>
                              <?
                              $queryx = "SELECT * FROM inf_lokasi where lokasi_propinsi='$provinsi' and lokasi_kecamatan=0 and lokasi_kelurahan=0 and lokasi_kabupatenkota!=0 order by lokasi_nama";
                              $queryx = $this->db->query($queryx);
                              if ($queryx->num_rows()>0) {
                                foreach($queryx->result() as $dataKota) {
                                  ?><option <? if ($kota==$dataKota->lokasi_kabupatenkota) { ?>selected="selected"<? } ?> value='<?=$dataKota->lokasi_kabupatenkota?>'><?=$dataKota->lokasi_nama?></option><?
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          Kecamatan
                          <div>
                            <select class="form-control"  name="kec" id="kec" onchange="ajaxkel(this.value)" data-placeholder="pilih kecamatan...">
                              <option value=""></option>
                              <?
                              $queryx = "SELECT * FROM inf_lokasi where lokasi_propinsi='$provinsi' and lokasi_kecamatan!=0 and lokasi_kelurahan=0 and lokasi_kabupatenkota='$kota' order by lokasi_nama";
                              $queryx = $this->db->query($queryx);
                              if ($queryx->num_rows()>0) {
                                foreach($queryx->result() as $dataKec) {
                                  ?><option <? if ($kecamatan==$dataKec->lokasi_kecamatan) { ?>selected="selected"<? } ?> value='<?=$dataKec->lokasi_kecamatan?>'><?=$dataKec->lokasi_nama?></option><?
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          Kelurahan
                          <div>
                            <select class="form-control"  name="kel" id="kel">
                              <?
                              $queryx = "SELECT * FROM inf_lokasi where lokasi_propinsi='$provinsi' and lokasi_kecamatan='$kecamatan' and lokasi_kelurahan!=0 and lokasi_kabupatenkota='$kota' order by lokasi_nama";
                              $queryx = $this->db->query($queryx);
                              if ($queryx->num_rows()>0) {
                                foreach($queryx->result() as $datakel) {
                                  ?><option <? if ($kelurahan==$datakel->lokasi_kelurahan) { ?>selected="selected"<? } ?> value='<?=$datakel->lokasi_kelurahan?>'> <?=$datakel->lokasi_nama?> </option> <?
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="center">
													<div class="center">
														<button class="btn btn-info btn-xs" type="submit" name="cari" id="cari">
															<i class="ace-icon fa fa-search bigger-110"></i>
															Cari
														</button>
													</div>
												</div>

											</div>
										</div><!-- /.modal-content -->
						</form>
										<button class="aside-trigger btn btn-info btn-app btn-xs ace-settings-btn" data-target="#right-menu" data-toggle="modal" type="button">
											<i data-icon1="fa-plus" data-icon2="fa-minus" class="ace-icon fa fa-plus bigger-110 icon-only"></i>
										</button>
									</div><!-- /.modal-dialog -->
								</div>

			<?php $this->load->view('layout/footer_top');?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		<script src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
		<!-- basic scripts -->

		<!--[if !IE]> -->


		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- page specific plugin scripts -->
    <script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/spinbox.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/daterangepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.knob.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/autosize.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.inputlimiter.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-tag.min.js"></script>
		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			   $('#sidebar2').insertBefore('.page-content');
			   $('#navbar').addClass('h-navbar');
			   $('.footer').insertAfter('.page-content');

			   $('.page-content').addClass('main-content');

			   $('.menu-toggler[data-target="#sidebar2"]').insertBefore('.navbar-brand');


			   $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
				 if(event_name == 'sidebar_fixed') {
					 if( $('#sidebar').hasClass('sidebar-fixed') ) $('#sidebar2').addClass('sidebar-fixed')
					 else $('#sidebar2').removeClass('sidebar-fixed')
				 }
			   }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);

			})
		</script>

		<script type="text/javascript">

			jQuery(function($) {
				$('.modal.aside').ace_aside();

				$('#aside-inside-modal').addClass('aside').ace_aside({container: '#my-modal > .modal-dialog'});



				$('#right-menu').modal('show');

				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove before leaving page
					$('.modal.aside').remove();
					$(window).off('.aside');
				});

				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true,
				})


			})
		</script>


		<!-- inline scripts related to this page -->

		<!-- Bootstrap 3.3.2 JS -->
		<script src="<?php echo base_url();?>plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>plugins/media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>plugins/media/js/jquery.dataTables.js"></script>

		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>plugins/datatables/dataTables.colResize.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>plugins/datatables/dataTables.colVis.js"></script>
		<script type="text/javascript" language="javascript" class="init">
		var manageMemberTable;
		$(document).ready(function() {
			manageMemberTable = $("#manageMemberTable").DataTable({
				"ajax": "<?php echo base_url();?>pencarian/php_action/retrieve.php?skill=<?=$skill?>&genre=<?=$genre?>&provinsi=<?=$provinsi?>&kota=<?=$kota?>&kecamatan=<?=$kecamatan?>&kelurahan=<?=$kelurahan?>",
				"order": [],
				"processing": true,
				"scrollX": true,
				"autoWidth": true,
				"dom": 'C<"clear">RZlfrtip',
				"colResize": {
					"tableWidthFixed": false
				}
			});
		});
		</script>

</body>
</html>
