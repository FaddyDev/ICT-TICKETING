<?php if(session_status()==PHP_SESSION_NONE){
session_start();} 
if (isset($_SESSION['loggedin'])){ ?>
<html>
<head> <title> Helpdesk </title>
<link href="bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
<style>
.table{
	width: 99.5%;
	margin: auto;
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
input { margin-left: 40px; 
	font: bold 12px/30px Georgia, serif;
}
</style>
</head>
<body>
<div id="Everything" style ="" Cclass="container">
	<div id="topnav" style ="">
	<p> Kenya Forestry Research Institute </p> 
	<p>ICT HELP DESK</p>
	<p> Administrator's Panel </p> 
	<p><a href="index.php" class="btn btn-info">Home/Inquire</a> <a href="login.php?sts=out" class="btn btn-warning">Logout</a> </p>
 </div>
  <div id="Content"> 
<div class="table-responsive">
<div id: "Options" style= "display: flex; align-items: center; justify-content: center; color: 000000;">
 <form method="post" = action= "viewadmin.php"> 
	 <input name="all" type="submit" value= "View all Tickets" /> 
 </form>
 <form method="post" = action= "viewadmin.php"> 
	 <input type="submit" name="fixed" value= "View all Fixed" /> 
 </form>
 <form method="post" = action= "viewadmin.php"> 
	 <input type="submit" name="progress" value= "View In Progress" /> 
 </form>
 <form method="post" = action= "viewadmin.php"> 
	 <input type="submit" name="ntfixed" value= "View all Unaddressed" /> 
 </form>
</div>

<?php if(isset($_SESSION["success"])){?>
      <?php $echo = $_SESSION["success"]; ?>
    <div class="alert alert-success" role="alert" style="text-align: center;"><?php echo $echo; ?> </div>
  <?php  unset($_SESSION['success']); } ?>


 <?php
$conn = mysqli_connect("localhost","root","","ICTHelpdeskTicketing");
if($conn == false){
die("error connecting db ".mysqli_connect_error());}
 
//Select according to the selected option
$sql = ''; $view = '';
//Default = all
$view = 'All Tickets';
$sql = "SELECT ID, Name, KefriMail, Location, Department, ExtensionPhone, Problem, Entered, Status, Technician FROM inquiries";
if (isset($_POST['all'])){ //all
 $sql = "SELECT ID, Name, KefriMail, Location, Department, ExtensionPhone, Problem, Entered, Status, Technician FROM inquiries";
 $view = 'All Tickets';
}
if (isset($_POST['fixed'])){ //fixed
	$sql = "SELECT ID, Name, KefriMail, Location, Department, ExtensionPhone, Problem, Entered, Status, Technician FROM inquiries WHERE Status = 'Fixed'";
	$view = 'Fixed Tickets';
}
if (isset($_POST['progress'])){ //In Progress
	$sql = "SELECT ID, Name, KefriMail, Location, Department, ExtensionPhone, Problem, Entered, Status, Technician FROM inquiries WHERE Status = 'In Progress'";
	$view = 'Tickets In Progress';
}
if (isset($_POST['ntfixed'])){ //Not fixed
	$sql = "SELECT ID, Name, KefriMail, Location, Department, ExtensionPhone, Problem, Entered, Status, Technician FROM inquiries WHERE Status = 'Not Fixed'";
	$view = 'Unaddressed Tickets';
}
echo "  <div class='alert alert-info' role='alert'>".$view." </div>";

$result = $conn->query($sql);
 
 if ($result->num_rows > 0) 
	 {
		 echo "<table class='table table-stripped table-bordered table-condensed' > 
		 <tr> <th> Ticket Number </th> <th> Name </th> <th> KefriMail </th> <th> Location </th> <th> Department </th> <th> ExtensionPhone </th> <th> Problem </th> <th> Entered </th> <th> Status </> <th> Technician </th> <th></th> </tr> ";
	 // output data of each row
	 while($row = $result->fetch_assoc()) {
		 echo " <tr>
		 <td>".$row["ID"]."</td>
		 <td>".$row["Name"]."</td> 
		 <td>".$row["KefriMail"]."</td>
		 <td>".$row["Location"]."</td>
		 <td>".$row["Department"]."</td>
		 <td>".$row["ExtensionPhone"]."</td>
		 <td>".$row["Problem"]."</td> 
		 <td>".$row["Entered"]."</td> 
		 <td>".$row["Status"]."</td> 
		 <td>".$row["Technician"]."</td> 
		 <td><a href='assign.php?Assign=" . $row['ID'] ."'>Assign</a></td>
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
  <div id="footer_inner" style="width: 100%;" class="container">
  <div class="col-md-6" style=""><div id="text-3" class="widget widget_text"><h4 class="widgettitle">Staff Services</h4>	
  <div class="textwidget"><div style="margin-bottom:7px;"><a href="http://mail.kefri.org/gw/webacc" target="_blank">Staff Mail</a></div>
  <div style="margin-bottom:7px;"><a href="http://ess.kefri.org:8081/apex/f?p=101:1" target="_blank">HR Module</a></div><!-- <div style="margin-bottom:7px;" ><a href="http://10.10.1.111:8081/apex/f?p=101:1" target="_blank">HR Module- HQ</a></div> -->
  <div style="margin-bottom:7px;"><a href="http://kefri.org/?page_id=112">Staff Downloads</a></div>
  </div>
  </div><div id="text-7"><div class="textwidget"><b><font size="21" color="#fff"> </font></b> <font size="1.75">ISO 14001:2004 EMS Certified</font></div>
  </div>
  </div>
  <div class="col-md-6">
	  <div id="text-5" class="widget widget_text"><h4 class="widgettitle">Contact Us</h4>			<div class="textwidget">Kenya Forestry Research Institute<br>
		  P.O Box 20412 - 00200 Nairobi<br>
		  Tel: +254-724-259781/2, <br>Wireless: +254-2010651/2<br>
		  Email: info@kefri.org <br> <br></div>
  </div>
  </div>
  </div>
</div> 
</body>
</html>
<?php } else{echo "Go back, you're not an admin.";} ?>