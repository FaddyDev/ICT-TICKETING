<?php if(session_status()==PHP_SESSION_NONE){
session_start();} 
if (!(isset($_POST['asn']))){ 
if (isset($_GET['Assign'])){ ?>
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
	<p><a href="index.php" class="btn btn-info">Home/Inquire</a> <a href="login.php?sts=out" class="btn btn-warning">Logout</a></p>
 </div>
 
 <div id="Content"> 
 <div id="main" align="center">
<i> For Assigning Ticket to a Technician </i> <br> 
<br> <form action="assign.php" method="POST">
Ticket Number: <br> <input type="text" name="ID" value="<?php echo $_GET['Assign'] ?>" readonly='readonly' style = "margin-left: +10px"> <br>
Assign To: <br> <select type= "text" name="Technician" style= "margin-left: +10px" required> <br> 
<option value="None"> None </option>
<option value="James Murithi"> James Murithi </option>
<option value="Caroline Achieng"> Caroline Achieng </option>
<option value="Wycliffe Smart"> Wycliffe Smart </option>
<option value="Ronald Ngara"> Ronald Ngara </option>
<option value="Davies Mutuku"> Davies Mutuku </option>
<option value="Cristopher Wafula"> Cristopher Wafula</option>
</select><br> <br> 
<input type="Submit" name="asn" value="Assign Ticket" style= "margin-left: +10px;">
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
	$tech = mysqli_real_escape_string($link, $_POST['Technician']);
		
	$sql = "UPDATE inquiries SET Technician = '$tech' WHERE ID = '$tkt' ";
	if(mysqli_query($link,$sql)){
		$_SESSION['success'] = 'Ticket number '.$tkt.' assigned successfully!';
		?>
		<script>
		window.location.href = 'viewadmin.php';
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
