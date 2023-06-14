<?php
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
    $no_telp = $dataus->no_telp;
    $alamat_web = $dataus->alamat_web;
    $alamat_google = $dataus->alamat_google;
    $alamat_twitter = $dataus->alamat_twitter;
    $alamat_facebook = $dataus->alamat_facebook;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title . ' - ' . $subtitle;?></title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="icon" href="<?=base_url()?>Graduation_Hat-512.ico">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.min.css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/media/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/resources/syntax/shCore.css">
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugins/css/dataTables.colVis.css">


		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>


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
    <script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
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

			   $('#sidebar2[data-sidebar-hover=true]').ace_sidebar_hover('reset');
			   $('#sidebar2[data-sidebar-scroll=true]').ace_sidebar_scroll('reset', true);
			})
		</script>


		<!-- inline scripts related to this page -->
    <script type="text/javascript">
			jQuery(function($) {
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});


				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true});
					//resize the chosen on window resize

					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': '90%'});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': '90%'});
						})
					});


					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			});
		</script>
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
		"ajax": "<?php echo base_url();?>formal_edu/php_action/retrieve.php?id=<?=$user_id2?>",
		"order": [],
		"processing": true,
		"dom": 'C<"clear">RZlfrtip',
		"colResize": {
			"tableWidthFixed": false
		}
	});

	$("#addMemberModalBtn").on('click', function() {
		// reset the form
		$("#createMemberForm")[0].reset();
		// remove the error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".messages").html("");

		// submit form
		$("#createMemberForm").unbind('submit').bind('submit', function() {

			$(".text-danger").remove();

			var form = $(this);

			// validation
			var level = $("#level").val();
      var nama_sekolah = $("#nama_sekolah").val();
      var jurusan = $("#jurusan").val();
			var thna = $("#thna").val();
      var thnb = $("#thnb").val();
			var userid = $("#userid").val();

			if(level == "") {
				$("#level").closest('.form-group').addClass('has-error');
				$("#level").after('<p class="text-danger">Kolom jenjang harus diisi</p>');
			} else {
				$("#level").closest('.form-group').removeClass('has-error');
				$("#level").closest('.form-group').addClass('has-success');
			}

      if(thna == "") {
				$("#thna").closest('.form-group').addClass('has-error');
				$("#thna").after('<p class="text-danger">Tahun masuk harus diisi</p>');
			} else {
				$("#thna").closest('.form-group').removeClass('has-error');
				$("#thna").closest('.form-group').addClass('has-success');
			}

      if(thnb == "") {
				$("#thnb").closest('.form-group').addClass('has-error');
				$("#thnb").after('<p class="text-danger">Tahun lulus harus diisi</p>');
			} else {
				$("#thnb").closest('.form-group').removeClass('has-error');
				$("#thnb").closest('.form-group').addClass('has-success');
			}

			if(level && thna && thnb) {
				//submi the form to server
				$.ajax({
					url : form.attr('action'),
					type : form.attr('method'),
					data : form.serialize(),
					dataType : 'json',
					success:function(response) {

						// remove the error
						$(".form-group").removeClass('has-error').removeClass('has-success');

						if(response.success == true) {
							$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

							// reset the form
							$("#createMemberForm")[0].reset();

							// reload the datatables
							manageMemberTable.ajax.reload(null, false);
							// this function is built in function of datatables;

						} else {
							$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
						}  // /else
					} // success
				}); // ajax subit
			} /// if


			return false;
		}); // /submit form for create member
	}); // /add modal

});

function removeMember(id = null) {
	if(id) {
		// click on remove button
		$("#removeBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: '<?php echo base_url();?>formal_edu/php_action/remove.php',
				type: 'post',
				data: {member_id : id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						$(".removeMessages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

						// refresh the table
						manageMemberTable.ajax.reload(null, false);

						// close the modal
						$("#removeMemberModal").modal('hide');

					} else {
						$(".removeMessages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
					}
				}
			});
		}); // click remove btn
	} else {
		alert('Error: Refresh the page again');
	}
}

function editMember(id = null) {
	if(id) {

		// remove the error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$(".text-danger").remove();
		// empty the message div
		$(".edit-messages").html("");

		// remove the id
		$("#member_id").remove();

		// fetch the member data
		$.ajax({
			url: '<?php echo base_url();?>formal_edu/php_action/getSelectedMember.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {
				$("#editlevel").val(response.level);
        $("#editnama_sekolah").val(response.nama_sekolah);
        $("#editjurusan").val(response.jurusan);
				$("#editthna").val(response.thna);
        $("#editthnb").val(response.thnb);

				// mmeber id
				$(".editMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updateMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var editlevel = $("#editlevel").val();
          var editnama_sekolah = $("#editnama_sekolah").val();
          var editjurusan = $("#editjurusan").val();
					var editthna = $("#editthna").val();
          var editthnb = $("#editthnb").val();

					if(editlevel == "") {
						$("#editlevel").closest('.form-group').addClass('has-error');
						$("#editlevel").after('<p class="text-danger">Kolom jenjang harus diisi</p>');
					} else {
						$("#editlevel").closest('.form-group').removeClass('has-error');
						$("#editlevel").closest('.form-group').addClass('has-success');
					}

					if(editthna == "") {
						$("#editthna").closest('.form-group').addClass('has-error');
						$("#editthna").after('<p class="text-danger">Kolom tahun masuk harus diisi</p>');
					} else {
						$("#editthna").closest('.form-group').removeClass('has-error');
						$("#editthna").closest('.form-group').addClass('has-success');
					}

          if(editthnb == "") {
						$("#editthnb").closest('.form-group').addClass('has-error');
						$("#editthnb").after('<p class="text-danger">Kolom tahun lulus harus diisi</p>');
					} else {
						$("#editthnb").closest('.form-group').removeClass('has-error');
						$("#editthnb").closest('.form-group').addClass('has-success');
					}

					if(editlevel && editthna && editthnb) {
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if(response.success == true) {
									$(".edit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
									'</div>');

									// reload the datatables
									manageMemberTable.ajax.reload(null, false);
									// this function is built in function of datatables;

									// remove the error
									$(".form-group").removeClass('has-success').removeClass('has-error');
									$(".text-danger").remove();
								} else {
									$(".edit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
									'</div>')
								}
							} // /success
						}); // /ajax
					} // /if

					return false;
				});

			} // /success
		}); // /fetch selected member info

	} else {
		alert("Error : Refresh the page again");
	}
}

</script>
</body>
</html>
