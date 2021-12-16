<?php if(session_status()==PHP_SESSION_NONE){
session_start();} 
if (!(isset($_POST['login']))){
	if (isset($_GET['sts'])){unset($_SESSION['loggedin']);}
	?>
	<script>
	window.location.href = 'index.php';
	</script>
	<?php 
}
else{
$link = mysqli_connect("localhost","root","","ICTHelpdeskTicketing");
if($link == false){
die("error connecting db ".mysqli_connect_error());
		}
$user = mysqli_real_escape_string($link, $_POST['username']);
$pass = mysqli_real_escape_string($link, $_POST['password']);
$sql = "SELECT * FROM users WHERE username='".$user."' and password = '".$pass."' ";
$result = $link->query($sql);
if ($result->num_rows > 0) {
	$position = "";
	while($row = $result->fetch_assoc()) {
		$position = $row["position"];
	}
	$_SESSION['loggedin'] = true;
	?>
	<script>
	window.location.href = 'viewadmin.php';
	</script>
	<?php 
}
else{
	$_SESSION['fail'] = "Login failed! Check your username and password then try again.";
	?>
	<script>
	window.location.href = 'index.php';
	</script>
	<?php 
}	
	mysqli_close($link);
}
?>
