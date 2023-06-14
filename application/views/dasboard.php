<?php
$this->db->select('myuser.*, tprofiluser.*');
$this->db->from('myuser');
$this->db->join('tprofiluser', 'myuser.id = tprofiluser.userid');
$user_id2 = $_SESSION["sess_user_id"];
$where2 = "myuser.id = '".$user_id2."'";
$this->db->where($where2);
$query2 = $this->db->get();
foreach( $query2->result() as $dataus ) {
    $provinsi = $dataus->provinsi;
		$kota = $dataus->kota;
    $kecamatan = $dataus->kecamatan;
    $kelurahan = $dataus->kelurahan;
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
							<li class="active">Dashboard</li>
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

						<?
						if (($kota=="")||($kecamatan=="")||($kelurahan=="")) {
							// jika belum jelas alamatnya
							?>
							<div class="row">
								<div class="col-xs-12">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->

										<div class="alert alert-block alert-danger">
											<button type="button" class="close" data-dismiss="alert">
												<i class="ace-icon fa fa-times"></i>
											</button>

											<i class="ace-icon fa fa-exclamation-circle red"></i>
											Complete the domicile location to facilitate the search for people who need the services of expertise that you share to the public
										</div>


										<!-- PAGE CONTENT ENDS -->
									</div><!-- /.col -->

									<!-- PAGE CONTENT ENDS -->
								</div><!-- /.col -->
							</div><!-- /.row -->
							<form method="post">
							<div class="tab-content profile-edit-tab-content">
							<div id="edit-basic" class="tab-pane active">
							<div class="row">
							<div class="col-xs-12 col-sm-8">
								<div class="space"></div>
								<h4 class="header blue bolder smaller">Domicile Location</h4>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="provinsi">Province</label>
									<div class="col-sm-3">
										<select class="form-control" name="prop" id="prop" onchange="ajaxkota(this.value)" data-placeholder="pilih provinsi...">
											<option value="">Select a province</option>
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

								<div class="space-4"></div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="kec">districts</label>
									<div class="col-sm-3">
										<select class="form-control"  name="kec" id="kec" onchange="ajaxkel(this.value)" data-placeholder="select the district...">
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
									<label class="col-sm-3 control-label no-padding-right" for="kel">sub districts</label>
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
							</div>
							</div>
							</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info btn-xs" type="submit" name="save" id="save">
										<i class="ace-icon fa fa-check bigger-110"></i>
										Save
									</button>

									&nbsp; &nbsp;
									<button class="btn btn-default btn-xs" type="reset">
										<i class="ace-icon fa fa-undo bigger-110"></i>
										Repeat
									</button>
								</div>
							</div>
							</form>
							<?
							// end belum jelas alamatnya
						} else {
						?>


						<div class="row">
							<div class="col-xs-12">
								<div class="col-xs-12">
									<!-- PAGE CONTENT BEGINS -->

									<div class="alert alert-block alert-success">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-check green"></i>

										Welcome to
										<strong class="green">
											mySkills.com,
											<small></small>
										</strong>please complete your expertise in the skill menu & experience to be easily noticed by the public
									</div>


									<!-- PAGE CONTENT ENDS -->
								</div><!-- /.col -->

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->

						<? } ?>



					</div><!-- /.page-content -->
				</div>
			</div>
