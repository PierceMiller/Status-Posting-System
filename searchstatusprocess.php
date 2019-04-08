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
	$db = mysqli_connect($host, $user, $pswd, $dbnm) OR die('ERROR: unable to connect');

	if(!mysql_querry($db, "DESCRIBE 'status'"))
	{
		echo "<br>Database has not been set up, Return to Homepage";
		
		echo '<br><a href="index.html">Return to Homepage</a>';
		echo '<br><a href="searchstatusform.html">Search for another status</a>';
	}else{
	
	$statusSearch = $_GET['statusseatch'];
	if(empty($statusSearch)){
	
		echo "<br>Follow 'Search Status' link or Return to Homepage";
		
		echo '<br><a href="index.html">Return to Homepage';
		echo '<br><a href="searchstatusform.html">Search for another status</a>';
	}else{
	
	$statusQuer = "SELECT * FROM status WHERE StatusCode LIKE '%".$statusSearch."%' 
					       OR Status LIKE '%".$statusSearch."%' 
					       OR Date LIKE '%".$statusSearch."%'
					       OR Share LIKE '%".$statusSearch."%'
					       OR Permission LIKE '%".$statusSearch."%'";

	$result = mysqli_query($db, $searchQuery);

	if(mysqli_num_rows($result) > 0){
	
		echo "<br>Matches for $statusSearch<br><br>";

		while($rows = mysqli_fetch_assoc($result)){
		
			echo "Status Code: ".$rows["StatusCode"];
			echo "<br>Status: ".$rows["Status"];

			echo "<br><br>Share: ".$rows["Share"];
			echo "<br>Date Posted: ".$rows['Date'];
			echo "<br>Permission Type: ".$rows["Permission"];

		}
	
		echo '<br><a href="searchstatusform.html">Search for another status</a>';
		echo '<a style="float:right" href="index.html">Return to Homepage</a>';
	
	}else{
	
		echo "No matches found, Return to Homepage or Search for another status";	
		echo '<br><a href="searchstatusform.html">Search for another status</a>';
		echo '<a style="float:right" href="index.html">Return to Homepage</a>';
		}
	}
}

?>

</body>
</html>

	

	

	
	
 




	