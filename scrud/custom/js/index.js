// global the manage memeber table
var manageMemberTable;

$(document).ready(function() {
	manageMemberTable = $("#manageMemberTable").DataTable({
		"ajax": "<?php echo base_url();?>scrud/php_action/retrieve.php",
		"order": []
	});



});
