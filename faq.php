<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<html>
<head> <title> Helpdesk </title>
<link href="bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
<style>
	th{
		text-align: center;
	}
}
table, th, td {
   font: Trebuchet MS;
}

th {
    height: 50px;
	background-color: #F0E68C;
}
 tr:nth-of-type(odd) {
      background-color:#ccc;
	  
 }
 tbody:hover td {
	color: transparent;
	text-shadow: 0 0 3px #ccc;
}
tbody:hover tr:hover td {
	color: #000000;
	text-shadow: 0 1px 0 #fff;
	 font: bold 12px/30px Georgia, serif;
}
</style>
</head>
<body>
<div id="Everything" style ="" class="container">
	<div id="topnav" style ="">
	<p> Kenya Forestry Research Institute </p> 
	<p>ICT HELP DESK</p>
	<p>FREQUENTLY ASKED QUESTIONS<p>
	<p><a href="index.php" class="btn btn-info">Home/Inquire</a> <a href="viewtech.php" class="btn btn-info">Technician View</a> <a href="viewadmin.php" class="btn btn-info">Admin View</a> </p>
 </div>
 
 <div id="Content" class="table-responsive"> 
 <?php
 $conn = mysqli_connect("localhost","root","","ICTHelpdeskTicketing");
 if($conn == false){
 die("error connecting db ".mysqli_connect_error());}
  $sql = "SELECT Problem, Suggestion FROM inquiries WHERE Suggestion != 'None'";
 
 $result = $conn->query($sql);
  
  if ($result->num_rows > 0) 
	  {
		  echo "<table class='table table-stripped table-bordered table-condensed' > 
		  <tr> <th> Question </th> <th>Suggestion </th> </tr> ";
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		  echo " <tr>
		  <td>".$row["Problem"]."</td> 
		  <td>".$row["Suggestion"]."</td> 
		  </tr>";
	  }
	  echo "</table>";
  } else {
	  echo "0 results";
  }
  $conn->close();
  ?> 
</div>
</div>
  <?php include('footer.php'); ?>
 </body>
</html>
