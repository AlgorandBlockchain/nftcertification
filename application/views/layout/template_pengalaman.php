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

		<script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.easypiechart.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.sparkline.index.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.pie.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.resize.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})

				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});


			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;

			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne",
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);

			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);


			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;

			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}

			 });

				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});




				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}

				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}

				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}


				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});


				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();

					var off2 = $source.offset();
					//var w2 = $source.width();

					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}


				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });


				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if(ace.vars['touch'] && ace.vars['android']) {
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				  });
				}

				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});


				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();

					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});

			})
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
		"ajax": "<?php echo base_url();?>pengalaman/php_action/retrieve.php?id=<?=$user_id2?>",
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
			var bekerja_di = $("#bekerja_di").val();
			var thna = $("#thna").val();
      var thnb = $("#thnb").val();
      var status_kerja = $("#status_kerja").val();
      var posisi = $("#posisi").val();
      var uraian_pekerjaan = $("#uraian_pekerjaan").val();
			var userid = $("#userid").val();

			if(bekerja_di == "") {
				$("#bekerja_di").closest('.form-group').addClass('has-error');
				$("#bekerja_di").after('<p class="text-danger">The Company field is required</p>');
			} else {
				$("#bekerja_di").closest('.form-group').removeClass('has-error');
				$("#bekerja_di").closest('.form-group').addClass('has-success');
			}

      if(thna == "") {
				$("#thna").closest('.form-group').addClass('has-error');
				$("#thna").after('<p class="text-danger">The From Year field is required</p>');
			} else {
				$("#thna").closest('.form-group').removeClass('has-error');
				$("#thna").closest('.form-group').addClass('has-success');
			}

      if(thnb == "") {
				$("#thnb").closest('.form-group').addClass('has-error');
				$("#thnb").after('<p class="text-danger">The Until Year field is required</p>');
			} else {
				$("#thnb").closest('.form-group').removeClass('has-error');
				$("#thnb").closest('.form-group').addClass('has-success');
			}

      if(bekerja_di == "") {
				$("#status_kerja").closest('.form-group').addClass('has-error');
				$("#status_kerja").after('<p class="text-danger">The Job Status field is required</p>');
			} else {
				$("#status_kerja").closest('.form-group').removeClass('has-error');
				$("#status_kerja").closest('.form-group').addClass('has-success');
			}

      if(posisi == "") {
				$("#posisi").closest('.form-group').addClass('has-error');
				$("#posisi").after('<p class="text-danger">The Job Position field is required</p>');
			} else {
				$("#posisi").closest('.form-group').removeClass('has-error');
				$("#posisi").closest('.form-group').addClass('has-success');
			}

			if(uraian_pekerjaan == "") {
				$("#uraian_pekerjaan").closest('.form-group').addClass('has-error');
				$("#uraian_pekerjaan").after('<p class="text-danger">The Job Description field is required</p>');
			} else {
				$("#uraian_pekerjaan").closest('.form-group').removeClass('has-error');
				$("#uraian_pekerjaan").closest('.form-group').addClass('has-success');
			}

			if(bekerja_di && thna && thnb && status_kerja && posisi && uraian_pekerjaan) {
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
				url: '<?php echo base_url();?>pengalaman/php_action/remove.php',
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
			url: '<?php echo base_url();?>pengalaman/php_action/getSelectedMember.php',
			type: 'post',
			data: {member_id : id},
			dataType: 'json',
			success:function(response) {
				$("#editbekerja_di").val(response.bekerja_di);
				$("#editthna").val(response.thna);
        $("#editthnb").val(response.thnb);
        $("#editstatus_kerja").val(response.status_kerja);
        $("#editposisi").val(response.posisi);
        $("#edituraian_pekerjaan").val(response.uraian_pekerjaan);

				// mmeber id
				$(".editMemberModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');

				// here update the member data
				$("#updateMemberForm").unbind('submit').bind('submit', function() {
					// remove error messages
					$(".text-danger").remove();

					var form = $(this);

					// validation
					var editbekerja_di = $("#editbekerja_di").val();
					var editthna = $("#editthna").val();
          var editthnb = $("#editthnb").val();
          var editstatus_kerja = $("#editstatus_kerja").val();
          var editposisi = $("#editposisi").val();
          var edituraian_pekerjaan = $("#edituraian_pekerjaan").val();

					if(editbekerja_di == "") {
						$("#editbekerja_di").closest('.form-group').addClass('has-error');
						$("#editbekerja_di").after('<p class="text-danger">The Company field is required</p>');
					} else {
						$("#editbekerja_di").closest('.form-group').removeClass('has-error');
						$("#editbekerja_di").closest('.form-group').addClass('has-success');
					}

					if(editthna == "") {
						$("#editthna").closest('.form-group').addClass('has-error');
						$("#editthna").after('<p class="text-danger">The From Year field is required</p>');
					} else {
						$("#editthna").closest('.form-group').removeClass('has-error');
						$("#editthna").closest('.form-group').addClass('has-success');
					}

          if(editthnb == "") {
						$("#editthnb").closest('.form-group').addClass('has-error');
						$("#editthnb").after('<p class="text-danger">The Until Year field is required</p>');
					} else {
						$("#editthnb").closest('.form-group').removeClass('has-error');
						$("#editthnb").closest('.form-group').addClass('has-success');
					}

          if(editstatus_kerja == "") {
						$("#editstatus_kerja").closest('.form-group').addClass('has-error');
						$("#editstatus_kerja").after('<p class="text-danger">The Job Status field is required</p>');
					} else {
						$("#editstatus_kerja").closest('.form-group').removeClass('has-error');
						$("#editstatus_kerja").closest('.form-group').addClass('has-success');
					}

          if(editposisi == "") {
						$("#editposisi").closest('.form-group').addClass('has-error');
						$("#editposisi").after('<p class="text-danger">The Job Position field is required</p>');
					} else {
						$("#editposisi").closest('.form-group').removeClass('has-error');
						$("#editposisi").closest('.form-group').addClass('has-success');
					}

          if(edituraian_pekerjaan == "") {
						$("#edituraian_pekerjaan").closest('.form-group').addClass('has-error');
						$("#edituraian_pekerjaan").after('<p class="text-danger">The Job Description field is required</p>');
					} else {
						$("#edituraian_pekerjaan").closest('.form-group').removeClass('has-error');
						$("#edituraian_pekerjaan").closest('.form-group').addClass('has-success');
					}

					if(editbekerja_di && editthna && editthnb && editstatus_kerja && editposisi) {
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
