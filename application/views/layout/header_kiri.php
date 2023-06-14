<div id="navbar" class="navbar navbar-default          ace-save-state navbar-fixed-top">

	<?php



	$this->db->select('myuser.kelasuser, myuser.id, timage.user_id, timage.lokasi_file, myuser.nama');
	$this->db->from('myuser');
	$this->db->join('timage',' myuser.id = timage.user_id');
	$user_id = $_SESSION["sess_user_id"];
	$where = "myuser.id = '".$user_id."'";
	$this->db->where($where);
	$query = $this->db->get();
	$lokasi_file = base_url() . "assets/images/avatars/user.jpg";
	$nama = "";
  if ($query->num_rows()>0) {
		foreach( $query->result() as $userx ) {
			$lokasi_file = base_url() . '' . $userx->lokasi_file;
			$nama = $userx->nama;
		}
  }
	?>
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="<?php echo base_url();?>index.php/home/dasboard" class="navbar-brand">
						<small>
							<i class="fa fa-graduation-cap"></i>
							MySkills
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo $lokasi_file;?>" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo $nama;?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="profile">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo base_url();?>index.php/auth/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>
