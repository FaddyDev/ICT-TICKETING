<?php if(session_status()==PHP_SESSION_NONE){
session_start();} 
if (!(isset($_POST['tkt']))){ ?>
<html>
<head> <title> Helpdesk </title>
<link href="bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="Everything" style ="" class="container">
	<div id="topnav" style ="">
		<p> Kenya Forestry Research Institute </p> 
		<p>ICT HELP DESK</p>
		<p><a href="index.php" class="btn btn-info">Home/Inquire</a> <a href="viewtech.php" class="btn btn-info">Technician View</a> <a href="viewadmin.php" class="btn btn-info">Admin View</a> </p>
	</div>
 <div id="Slide">
 	<marquee behavior="scroll" direction="left">To enhance: Vision 2030 delivery; customer/stakeholder satisfaction and retention; linkage and partnership with stakeholders; and livelihoods.</marquee>
 </div> 
 <div id="Content" sstyle= "float: left; "> 
 <div id="left" class="side col-md-4">
	<p>	Thank you for contacting us. Kindly complete this form or Click FAQ link below. </p> 	 
 <br>
 <?php if(isset($_SESSION["success"])){?>
      <?php $echo = $_SESSION["success"]; ?>
     <div class="alert alert-success" role="alert"> <?php echo $echo; ?> </div>
  <?php  unset($_SESSION['success']); } ?>
 <div id="formo" style= "">
 	<form method ="post" action="index.php">
	Name: <br><input type="text" name="Name" required> <br>
	KefriMail: <br> <input type ="text" name="KefriMail" required> <br>
	Location: <br> <input type ="text" name="Location" required> <br>
	Department: <br><input type="text" name="Department" required> <br> 
	ExtensionPhone: <br> <input type ="tel" name="ExtensionPhone" required> <br>
	Problem: <br> <input type ="text" name="Problem" required> <br>
 	<input type="submit" name="tkt" value="Submit" />
 	</form> <br> <br> <br> 
 <a href="faq.php" class="btn btn-default">Frequently Asked Questions</a>
 </div> 
 </div> 
 <div id="center" class="col-md-4"><br> <br> <br> <br> 
 <p> Speak directly with a technician? </p> 
 <i> Then call: </i> 
  <p>  445 </p>
  <p>  362 </p>
  <p>  218 </p> 
 </div> 
 <div id="right" class="side col-md-4">
		<p>
		If you were previously assigned a ticket, kindly provide your feedback below, It would be important in guaranteeing quality service and in a timely manner</p> 	 
<br>
<?php if(isset($_SESSION["changed"])){?>
      <?php $echo = $_SESSION["changed"]; ?>
    <div class="alert alert-success" role="alert"> <?php echo $echo; ?> </div>
  <?php  unset($_SESSION['changed']); } ?>
 <?php if(isset($_SESSION["failed"])){?>
      <?php $echo = $_SESSION["failed"]; ?>
    <div class="alert alert-warning" role="alert"></span> <?php echo $echo; ?> </div>
  <?php  unset($_SESSION['failed']); } ?> <br>
  
<div id: "formo" align="center" style= "color: #17202a; width:240px;">
<form action="fix.php" method="POST">
Ticket Number :<br><input type="text" name="ID" required> <br>
Status: <br> 
<select type= "text" name="status" required>
<option> </option>
<option value="Fixed"> Fixed </option>
<option value="Not Fixed"> Not Fixed </option>
<option value="In Progress"> In Progress </option>
</select><br> <br> <br> 
<input type="Submit" name="change" value="Update Status">
 </form> <br> <br> <br>

 Admin Login
 <?php if(isset($_SESSION["fail"])){?>
      <?php $echo = $_SESSION["fail"]; ?>
    <div class="alert alert-warning" role="alert"></span> <?php echo $echo; ?> </div>
  <?php  unset($_SESSION['fail']); } ?>
<form action="login.php" method="POST">
<input type="text" name="username" placeholder="Username" required> <br> <br>
<input type="password" name="password" placeholder="Password" required> <br> <br>
<input type="Submit" name="login" value="Login">
 </form> 
</div> 
 </div> 
 </div> <br> <br> 
 
 
  </div>
 </div> 
 
  <?php include('footer.php'); ?>
 </body>
</html>
<?php
}
else{
$link = mysqli_connect("localhost","root","","ICTHelpdeskTicketing");
if($link == false){
die("error connecting db ".mysqli_connect_error());
		}
	$Name = mysqli_real_escape_string($link, $_POST['Name']);
	$KefriMail = mysqli_real_escape_string($link, $_POST['KefriMail']);
	$Location = mysqli_real_escape_string($link, $_POST['Location']);
	$Department = mysqli_real_escape_string($link, $_POST['Department']);
	$ExtensionPhone = mysqli_real_escape_string($link, $_POST['ExtensionPhone']);
	$Problem = mysqli_real_escape_string($link, $_POST['Problem']);
	$sql = "INSERT INTO inquiries(Name, KefriMail, Location, Department, ExtensionPhone, Problem, Status, Technician, Suggestion) 
	VALUES('$Name','$KefriMail','$Location', '$Department', '$ExtensionPhone','$Problem', 'Not Fixed', 'None', 'None')";
	if(mysqli_query($link,$sql)){
		$out = "Your request has been received. ". mysqli_insert_id($link) . " is your ticket number. Kindly use this for further 
		communication.";
		$_SESSION['success'] = $out;
		?>
		<script>
		window.location.href = 'index.php';
		</script>
		<?php 
			}
  else
		{
    echo "error occured".mysqli_error($link);
		}
	mysqli_close($link);
}
?>
