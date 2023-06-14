
<?
$this->db->select('myuser.*, tprofiluser.*');
          $this->db->from('myuser');
          $this->db->join('tprofiluser', 'myuser.id = tprofiluser.userid');
          $user_id2 = $_SESSION["sess_user_id"];
          $where2 = "myuser.id = '".$user_id2."'";
          $this->db->where($where2);
          $query2 = $this->db->get();
foreach( $query2->result() as $dataus ) {
    $warga_negara = $dataus->warga_negara;
		$first_name = $dataus->first_name;
		$last_name = $dataus->last_name;
		$username = $dataus->username;
		$tgl_lahir = date('Y-m-d', strtotime($dataus->tgl_lahir));
		$genre = $dataus->genre;
		$email = $dataus->email;
		$provinsi = $dataus->provinsi;
		$kota = $dataus->kota;
    $kecamatan = $dataus->kecamatan;
    $kelurahan = $dataus->kelurahan;
    $no_telp = $dataus->no_telp;
    $alamat_web = $dataus->alamat_web;
    $alamat_google = $dataus->alamat_google;
    $alamat_twitter = $dataus->alamat_twitter;
    $alamat_facebook = $dataus->alamat_facebook;
}
$this->db->select('myuser.kelasuser, myuser.id, timage.user_id, timage.lokasi_file, myuser.nama');
$this->db->from('myuser');
$this->db->join('timage',' myuser.id = timage.user_id');
$user_id = $_SESSION["sess_user_id"];
$where = "myuser.id = '".$user_id."'";
$this->db->where($where);
$query = $this->db->get();
$lokasi_file = "assets/images/avatars/profile-pic.jpg";
foreach( $query->result() as $userx ) {
	$lokasi_file = base_url() . '' . $userx->lokasi_file;
	$nama = $userx->nama;
}
?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Profile</li>
						</ul><!-- /.breadcrumb -->

            <div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
                  <a href="pencarian" class="btn btn-sm btn-primary btn-white btn-round">
            				<i class="ace-icon fa fa-search bigger-150 middle orange2"></i>
            				<span class="bigger-110">Find people with their expertise</span>
            				<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
            			</a>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">




						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->


								<div class="hide">
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<span class="profile-picture">

													<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="<?=$lokasi_file?>" />
												</span>

												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
															<i class="ace-icon fa fa-circle light-green"></i>
															&nbsp;
															<span class="white">Alex M. Doe</span>
														</a>

														<ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
															<li class="dropdown-header"> Change Status </li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-circle green"></i>
																	<span class="green">Available</span>
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-circle red"></i>
																	<span class="red">Busy</span>
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-circle grey"></i>

																	<span class="grey">Invisible</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>

											<div class="space-6"></div>

											<div class="profile-contact-info">
												<div class="profile-contact-links align-left">
													<a href="#" class="btn btn-link">
														<i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
														Add as a friend
													</a>

													<a href="#" class="btn btn-link">
														<i class="ace-icon fa fa-envelope bigger-120 pink"></i>
														Send a message
													</a>

													<a href="#" class="btn btn-link">
														<i class="ace-icon fa fa-globe bigger-125 blue"></i>
														www.alexdoe.com
													</a>
												</div>

												<div class="space-6"></div>

												<div class="profile-social-links align-center">
													<a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
														<i class="middle ace-icon fa fa-facebook-square fa-2x blue"></i>
													</a>

													<a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
														<i class="middle ace-icon fa fa-twitter-square fa-2x light-blue"></i>
													</a>

													<a href="#" class="tooltip-error" title="" data-original-title="Visit my Pinterest">
														<i class="middle ace-icon fa fa-pinterest-square fa-2x red"></i>
													</a>
												</div>
											</div>

											<div class="hr hr12 dotted"></div>

											<div class="clearfix">
												<div class="grid2">
													<span class="bigger-175 blue">25</span>

													<br />
													Followers
												</div>

												<div class="grid2">
													<span class="bigger-175 blue">12</span>

													<br />
													Following
												</div>
											</div>

											<div class="hr hr16 dotted"></div>
										</div>

										<div class="col-xs-12 col-sm-9">
											<div class="center">
												<span class="btn btn-app btn-sm btn-light no-hover">
													<span class="line-height-1 bigger-170 blue"> 1,411 </span>

													<br />
													<span class="line-height-1 smaller-90"> Views </span>
												</span>

												<span class="btn btn-app btn-sm btn-yellow no-hover">
													<span class="line-height-1 bigger-170"> 32 </span>

													<br />
													<span class="line-height-1 smaller-90"> Followers </span>
												</span>

												<span class="btn btn-app btn-sm btn-pink no-hover">
													<span class="line-height-1 bigger-170"> 4 </span>

													<br />
													<span class="line-height-1 smaller-90"> Projects </span>
												</span>

												<span class="btn btn-app btn-sm btn-grey no-hover">
													<span class="line-height-1 bigger-170"> 23 </span>

													<br />
													<span class="line-height-1 smaller-90"> Reviews </span>
												</span>

												<span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> 7 </span>

													<br />
													<span class="line-height-1 smaller-90"> Albums </span>
												</span>

												<span class="btn btn-app btn-sm btn-primary no-hover">
													<span class="line-height-1 bigger-170"> 55 </span>

													<br />
													<span class="line-height-1 smaller-90"> Contacts </span>
												</span>
											</div>

											<div class="space-12"></div>

											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> Username </div>

													<div class="profile-info-value">
														<span class="editable" id="username">alexdoe</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Location </div>

													<div class="profile-info-value">
														<i class="fa fa-map-marker light-orange bigger-110"></i>
														<span class="editable" id="country">Netherlands</span>
														<span class="editable" id="city">Amsterdam</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Age </div>

													<div class="profile-info-value">
														<span class="editable" id="age">38</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Joined </div>

													<div class="profile-info-value">
														<span class="editable" id="signup">2010/06/20</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Last Online </div>

													<div class="profile-info-value">
														<span class="editable" id="login">3 hours ago</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> About Me </div>

													<div class="profile-info-value">
														<span class="editable" id="about">Editable as WYSIWYG</span>
													</div>
												</div>
											</div>

											<div class="space-20"></div>

											<div class="widget-box transparent">
												<div class="widget-header widget-header-small">
													<h4 class="widget-title blue smaller">
														<i class="ace-icon fa fa-rss orange"></i>
														Recent Activities
													</h4>

													<div class="widget-toolbar action-buttons">
														<a href="#" data-action="reload">
															<i class="ace-icon fa fa-refresh blue"></i>
														</a>

														<a href="#" class="pink">
															<i class="ace-icon fa fa-trash-o"></i>
														</a>
													</div>
												</div>

												<div class="widget-body">
													<div class="widget-main padding-8">
														<div id="profile-feed-1" class="profile-feed">
															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="Alex Doe's avatar" src="assets/images/avatars/avatar5.png" />
																	<a class="user" href="#"> Alex Doe </a>
																	ubah foto profil.
																	<a href="#">Take a look</a>

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		an hour ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="Susan Smith's avatar" src="assets/images/avatars/avatar1.png" />
																	<a class="user" href="#"> Susan Smith </a>

																	is now friends with Alex Doe.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		2 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-check btn-success no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>
																	joined
																	<a href="#">Country Music</a>

																	group.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		5 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-picture-o btn-info no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>
																	uploaded a new photo.
																	<a href="#">Take a look</a>

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		5 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="David Palms's avatar" src="assets/images/avatars/avatar4.png" />
																	<a class="user" href="#"> David Palms </a>

																	left a comment on Alex's wall.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		8 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-pencil-square-o btn-pink no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>
																	published a new blog post.
																	<a href="#">Read now</a>

																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		11 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<img class="pull-left" alt="Alex Doe's avatar" src="assets/images/avatars/avatar5.png" />
																	<a class="user" href="#"> Alex Doe </a>

																	upgraded his skills.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		12 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-key btn-info no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>

																	logged in.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		12 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-power-off btn-inverse no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>

																	logged out.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		16 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>

															<div class="profile-activity clearfix">
																<div>
																	<i class="pull-left thumbicon fa fa-key btn-info no-hover"></i>
																	<a class="user" href="#"> Alex Doe </a>

																	logged in.
																	<div class="time">
																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
																		16 hours ago
																	</div>
																</div>

																<div class="tools action-buttons">
																	<a href="#" class="blue">
																		<i class="ace-icon fa fa-pencil bigger-125"></i>
																	</a>

																	<a href="#" class="red">
																		<i class="ace-icon fa fa-times bigger-125"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="hr hr2 hr-double"></div>

											<div class="space-6"></div>

											<div class="center">
												<button type="button" class="btn btn-sm btn-primary btn-white btn-round">
													<i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
													<span class="bigger-110">View more activities</span>

													<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
												</button>
											</div>
										</div>
									</div>
								</div>



								<div>
									<div id="user-profile-3" class="user-profile row">
										<div class="col-sm-offset-1 col-sm-10">


											<div class="space"></div>

											<form class="form-horizontal" method="post">
												<div class="tabbable">
													<ul class="nav nav-tabs padding-16">
														<li class="active">
															<a data-toggle="tab" href="#edit-basic">
																<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
																Main info
															</a>
														</li>

														<li>
															<a data-toggle="tab" href="#edit-settings">
																<i class="purple ace-icon fa fa-cog bigger-125"></i>
																Settings
															</a>
														</li>

														<li>
															<a data-toggle="tab" href="#edit-password">
																<i class="blue ace-icon fa fa-key bigger-125"></i>
																Keywords
															</a>
														</li>
													</ul>

													<div class="tab-content profile-edit-tab-content">
														<div id="edit-basic" class="tab-pane in active">
															<h4 class="header blue bolder smaller">General</h4>

															<div class="row">

                                <div class="col-xs-12 col-sm-3 center-block">

                                  <span class="profile-picture">
																     <img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="<?=$lokasi_file?>" />

															     </span>
															      <div class="space space-4"></div>
														    </div>

																<div class="vspace-12-sm"></div>

																<div class="col-xs-12 col-sm-8">
																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="username">Username</label>

																		<div class="col-sm-8">
																			<input class="col-xs-12 col-sm-10" type="text" id="username" name="username" placeholder="Username" value="<?=$username?>" />
																		</div>
																	</div>

																	<div class="space-4"></div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="first_name">Name</label>

																		<div class="col-sm-8">
																			<input class="input-small" type="text" id="first_name" name="first_name" placeholder="Nama depan" value="<?=$first_name;?>" />
																			<input class="input-small" type="text" id="last_name" name="last_name" placeholder="Nama belakang" value="<?=$last_name;?>" />
																		</div>
																	</div>

                                  <div class="form-group">
    																<label class="col-sm-4 control-label no-padding-right" for="tgl_lahir">Date of birth</label>

    																<div class="col-sm-8">
    																	<div class="input-medium">
    																		<div class="input-group">
    																			<input class="input-medium date-picker" id="tgl_lahir" name="tgl_lahir" type="text" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?=$tgl_lahir?>"/>
    																			<span class="input-group-addon">
    																				<i class="ace-icon fa fa-calendar"></i>
    																			</span>
    																		</div>
    																	</div>
    																</div>
    															</div>

    															<div class="space-4"></div>

    															<div class="form-group">
    																<label class="col-sm-4 control-label no-padding-right">Gender</label>

    																<div class="col-sm-8">
    																	<label class="inline">
    																		<input name="gender" id="gender" type="radio" <? if ($genre=="Male") { echo "checked"; } ?> class="ace" value="Male"/>
    																		<span class="lbl middle"> Male</span>
    																	</label>

    																	&nbsp; &nbsp; &nbsp;
    																	<label class="inline">
    																		<input name="gender" id="gender" type="radio" <? if ($genre=="Female") { echo "checked"; } ?> class="ace" value="Female"/>
    																		<span class="lbl middle"> Female</span>
    																	</label>
    																</div>
    															</div>

    															<div class="space-4"></div>

																</div>
															</div>

															<hr />




															<div class="space"></div>
															<h4 class="header blue bolder smaller">Contact</h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="warga_negara">Country</label>
																<div class="col-sm-3">
																	<select class="chosen-select form-control" name="warga_negara" id="warga_negara" data-placeholder="Choose a country...">
																		<option selected value="93">Indonesia</option>
																		<?php
																		//$this->db->select('*');
																		//$this->db->from('countries');
																		//$query3 = $this->db->get();
																		//foreach( $query3->result() as $datac ) {
																		//}
																		?>
																	</select>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="provinsi">Province</label>
																<div class="col-sm-3">
                                  <select class="form-control" name="prop" id="prop" onchange="ajaxkota(this.value)" data-placeholder="Select Province...">
					                          <option value=""></option>
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

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="kota">County / town</label>
																<div class="col-sm-3">
																	<select class="form-control"  name="kota" id="kota" onchange="ajaxkec(this.value)" data-placeholder="Choose a city...">
					                          <option value="">Pilih Kota</option>
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

                              <div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="kec">districts</label>
																<div class="col-sm-3">
																	<select class="form-control"  name="kec" id="kec" onchange="ajaxkel(this.value)" data-placeholder="Choose a districts...">
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

                              <div class="space-4"></div>

                              <div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="kel">Sub districts</label>
																<div class="col-sm-3">
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

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="email">Email</label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input type="email" id="email" name="email" value="<?=$email?>" disabled="disabled" />
																		<i class="ace-icon fa fa-envelope"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-website">Website</label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input type="url" id="alamat_web" name="alamat_web" value="<?=$alamat_web?>" />
																		<i class="ace-icon fa fa-globe"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-phone">Phone</label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input type="text" id="no_telp" name="no_telp" placeholder="" value="<?=$no_telp?>" />
																		<i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
																	</span>
																</div>
															</div>

															<div class="space"></div>
															<h4 class="header blue bolder smaller">Social media</h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-facebook">Facebook</label>

																<div class="col-sm-9">
																	<span class="input-icon">
																		<input type="text" id="alamat_facebook" name="alamat_facebook" value="<?=$alamat_facebook?>" />
																		<i class="ace-icon fa fa-facebook blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-twitter">Twitter</label>

																<div class="col-sm-9">
																	<span class="input-icon">
																		<input type="text" id="alamat_twitter" name="alamat_twitter" value="<?=$alamat_twitter?>" />
																		<i class="ace-icon fa fa-twitter light-blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-gplus">Google+</label>

																<div class="col-sm-9">
																	<span class="input-icon">
																		<input type="text" id="alamat_google" name="alamat_google" value="<?=$alamat_google?>" />
																		<i class="ace-icon fa fa-google-plus red"></i>
																	</span>
																</div>
															</div>
														</div>

														<div id="edit-settings" class="tab-pane">
															<div class="space-10"></div>

															<div>
																<label class="inline">
																	<input type="checkbox" name="form-field-checkbox" class="ace" />
																	<span class="lbl"> Share my profile publicly</span>
																</label>
															</div>

															<div class="space-8"></div>

															<div>
																<label class="inline">
																	<input type="checkbox" name="form-field-checkbox" class="ace" />
																	<span class="lbl"> Send notification to email</span>
																</label>
															</div>


														</div>

														<div id="edit-password" class="tab-pane">
															<div class="space-10"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">New Keyword</label>

																<div class="col-sm-9">
																	<input type="password" id="form-field-pass1" />
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">Confirm New Keyword</label>

																<div class="col-sm-9">
																	<input type="password" id="form-field-pass2" />
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">
														<button class="btn btn-info" type="submit" name="save" id="save">
															<i class="ace-icon fa fa-check bigger-110"></i>
															Save
														</button>

														&nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Reset
														</button>
													</div>
												</div>
											</form>
										</div><!-- /.span -->
									</div><!-- /.user-profile -->
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
