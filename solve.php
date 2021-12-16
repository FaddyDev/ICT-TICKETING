<?php if(session_status()==PHP_SESSION_NONE){
session_start();} 
if (!(isset($_POST['slv']))){ 
if (isset($_GET['solve'])){ ?>
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
	<p><a href="index.php" class="btn btn-info">Home/Inquire</a> </p>
 </div>
 
 <div id="Content"> 
 <div id="main" align="center">
<i> This page is for recording tried solutions to the issue in question, and stating whether the issue has been resolved.</i> <br> 
<br> <form action="solve.php" method="POST">
Ticket Number: <br> <input type="text" name="ID" value="<?php echo $_GET['solve'] ?>" readonly='readonly' style = "margin-left: +10px"> <br>
Solution: <br><textarea name="solution" required></textarea><br>
Status: <br> 
<select name="status" required>
<option value="<?php echo $_GET['sts'] ?>"> <?php echo $_GET['sts'] ?> </option>
<option value="Fixed"> Fixed </option>
<option value="Not Fixed"> Not Fixed </option>
<option value="In Progress"> In Progress </option>
</select><br> <br>  
<input type="Submit" name="slv" value="Update Status"><br>
</form>
 </form>
</div>  
  </div>
</div>
  <?php include('footer.php'); ?>
 </body>
</html>
<?php
}
}
else{
$link = mysqli_connect("localhost","root","","ICTHelpdeskTicketing");
if($link == false){
die("error connecting db ".mysqli_connect_error());
		}
	$tkt = mysqli_real_escape_string($link, $_POST['ID']);
	$soln = mysqli_real_escape_string($link, $_POST['solution']);
	$sts = mysqli_real_escape_string($link, $_POST['status']);
		
	$sql = "UPDATE inquiries SET Suggestion = '$soln', Status = '$sts' WHERE ID = '$tkt' ";
	if(mysqli_query($link,$sql)){
		$_SESSION['success'] = 'Ticket number '.$tkt.' updated successfully!';
		?>
		<script>
		window.location.href = 'viewtech.php';
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
