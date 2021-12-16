<?php if(session_status()==PHP_SESSION_NONE){
session_start();} 
if (isset($_POST['change'])){ 
$link = mysqli_connect("localhost","root","","ICTHelpdeskTicketing");
if($link == false){
die("error connecting db ".mysqli_connect_error());
		}
	$tkt = mysqli_real_escape_string($link, $_POST['ID']);
	$sts = mysqli_real_escape_string($link, $_POST['status']);
	
	$sql = "SELECT * FROM inquiries WHERE ID='".$tkt."' ";
	$result = $link->query($sql);
	if ($result->num_rows > 0) { 
	$sql = "UPDATE inquiries SET Status = '$sts' WHERE ID = '$tkt' ";
	if(mysqli_query($link,$sql)){
		$_SESSION['changed'] = 'Status of ticket number '.$tkt.' updated successfully!';
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
	}else{
		$_SESSION['failed'] = 'Ticket number '.$tkt.' does not exist!';
		?>
		<script>
		window.location.href = 'index.php';
		</script>
		<?php
	}
	mysqli_close($link);
}
?>
