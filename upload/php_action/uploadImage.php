<?php

if($_POST) {
	// database connection
	$server = 'localhost';
	$username = 'root';
	$password = '123';
	$dbname = 'dbmyskills';

	$conn = new mysqli($server, $username, $password, $dbname);

	// check db connection
	if($conn->connect_error) {
		die("Connection Failed : " . $conn->connect_error);
	}
	else {
		// echo "Successfully Connected";
	}

	$valid = array('success' => false, 'messages' => array());

	$name = "";
  $user_id = $_POST['user_id'];
	$type = explode('.', $_FILES['userImage']['name']);
	$type = $type[count($type) - 1];
	$nama_file = uniqid(rand()) . '.' . $type;
	$url = '../../payrollx/uploads/' .  $nama_file;
  $lokasi_file = 'payrollx/uploads/' . $nama_file;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
			if(move_uploaded_file($_FILES['userImage']['tmp_name'], $url)) {

				// insert into database
				$sqlx = "DELETE FROM timage WHERE user_id = '$user_id'";
				$query = $conn->query($sqlx);

				$sql = "INSERT INTO timage (user_id, lokasi_file, nama_file) VALUES ('$user_id', '$lokasi_file', '$name')";

				if($conn->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Uploaded";
				}
				else {
					$valid['success'] = false;
					$valid['messages'] = "Error while uploading";
				}

				$conn->close();

			}
			else {
				$valid['success'] = false;
				$valid['messages'] = "Error while uploading";
			}
		}
	} else {
			$valid['messages'] = $type;
		}

	echo json_encode($valid);

	// upload the file
}
