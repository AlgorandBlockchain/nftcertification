<?php

require_once 'db_connect.php';

$output = array('data' => array());

$sql = "SELECT * FROM tmyskill where userid = ".$_GET['id']."";
$query = $connect->query($sql);

$x = 1;
while ($row = $query->fetch_assoc()) {
	$category = '';
	$sqlx = "SELECT * FROM tcategory WHERE id = ".$row['category']."";
	$queryx = $connect->query($sqlx);
	$resultx = $queryx->fetch_assoc();
	$category = $resultx['name'];

	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editMemberModal" onclick="editMember('.$row['id'].')"> <span class="glyphicon glyphicon-edit"></span> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['id'].')"> <span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
	  </ul>
	</div>';

	$output['data'][] = array(
		$x,
		$row['skill'],
		$category,
		$actionButton
	);
	$x++;
}

// database connection close
$connect->close();

echo json_encode($output);
