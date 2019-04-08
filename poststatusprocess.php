<!DOCTYPE html>
<html>
<head>
<title>Status Posting System</title>
<meta charset="utf-8" http-equiv="content-type" content="text/html" />

	<style type="text/css">
		body {
		  border: 3px solid darkblue;
		  margin: 40px 410px 50px 410px;
		  padding: 10px 20px 5px 20px;
		}

	</style>
</head>
<body>

<h3 style="color:darkblue;">Status Posting System</h3>

<?php
	error_reporting(0);
	
	require_once('conf/settings.php');
	$db = mysqli_connect($host, $user, $pswd, $dbnm) OR die('ERROR: '. mysqli_connect_error());

	if('userstatus'!= NULL){
	$userStatus = $_POST['userstatus'];
		
		if('statuscode'!= NULL){
		$statusCode = $_POST['statuscode'];
			
			if('date' != NULL){
			$statusDate = $_POST['date'];
				
				if('share_type' != NULL){
				$shareType = $_POST['share_type'];
				
					if(isset($_POST['permission_type'])){
					$permissionType = implode(", ", $_POST['permission_type']);
					}
				}
			}
		}
	}else{

		echo"Please refer back to the return post link and ensure all necessary dields are checked";
	}
	
	if(empty($permissionType)){
		
		echo"<br>Please return to post and select one or more permission type/s when posting a status.";
		echo '<br><a href="poststatusform.php">return to post</a>';
	}else{
		
		$searchQuery = mysqli_query($db, "SELECT * FROM status WHERE StatusCode = '$statusCode'");
		
		if($searchQuery && mysqli_num_rows($searchQuery) > 0 ){
	
			echo "<br>Please enter another status code, as '$statusCode' has been used.";
			echo '<br><a href="poststatusform.php">return to post</a>';
		}else{
		
			mysqli_query($db, "INSERT INTO 'status' ('StatusCode', 
								 'Status', 
								 'Date', 
								 'Share',
								 'Permission') VALUES ('$statusCode',
										       '$userStatus',
										       '$statusDate',
										       '$permissionType',
										       '$shareType')");
			
			echo "<br>Your status has been saved plesae return to the homepage<br>"; 	
			echo '<br><a href="index.html">Return to Homepage </a>';
		}
	}
?>
</body>
</html>


	
	

		
