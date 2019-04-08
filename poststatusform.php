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

<script> 

        function TodaysDate() {

            	var dateGrid=new Date();
            	var date=dateGrid.toISOString().slice(0, -14);
            	document.getElementById("date").value=date; 
	} 
		
	function resetPage() {
		location.reload();
}
</script>
	  
</head>

<body onload="TodaysDate()">
<?php
	
	require_once ('conf/settings.php');
	$db = mysqli_connect($host,$user,$pswd,$dbnm) 
	OR die(' Error unable to connect to status database'); 
	
	if(!mysqli_query($db,"DESCRIBE status")) {  	
		mysqli_query($db,"CREATE TABLE status(= StatusCode VARCHAR(10) NOT NULL PRIMARY KEY , 
							Status VARCHAR(500) NOT NULL , 
							Date DATE NOT NULL , 
							Share VARCHAR(50) NOT NULL , 
							Permission VARCHAR(50) NOT NULL ) ENGINE = InnoDB;");
	}else { 
		echo"database loaded"; 
	}
		


?>
 <form action="poststatusprocess.php" method="post">   
 
	<h3 style="color:darkblue;">Status Posting System</h3><br>  
		
	Status Code(required):
	<input type="text" name="statuscode" maxlength="5" pattern="(?=.*[S]).{1}([0-9]{4})" title="Must contain  code is 5 characters in length and must start with an uppercase &quot; S &quot; letter followed by 4 numbers" required placeholder="Enter Code"/>
	<br>

	Status(required): 
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
	<input type="text" name="userstatus" pattern="[(,.!? 0-9A-Za-z)]+" title="The status can only contain alphanumeric characters including spaces, comma, period (full stop), exclamation point and question mark. Other characters or symbols are not allowed." required placeholder="Enter status"/>
	<br><br>		
			
	Share:
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="radio" name="share_type"value = "public"required >Public;
	&nbsp<input type="radio" name="share_type"value = "Friends"required>Friends;
	&nbsp<input type="radio" name="share_type"value = "Only Me"required>Only Me<br>
			 			
	Date:
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	<input type="date" id="date" name="date" pattern="^\d{2}\/\d{2}\/\d{2}$"/><br> 

	Permission Type:
	&nbsp<input type="checkbox" name="permission_type[]" value="Allow Like">Allow Like
	&nbsp<input type="checkbox" name="permission_type[]" value="Allow Comment ">Allow Comment
	&nbsp<input type="checkbox" name="permission_type[]" value="Allow Share"> Allow Share				
					 				
	<br><br>			
			
	<button type="submit">Post</button>		
	<button type="button" onclick="resetPage()">Reset</button>			
				
	<br><br>							
	<a href= "index.html">Return to Home Page </a>
	<a style="float:right" href="about.html">About this assignment</a>
		
							 
	</form> 

</body>
</html>