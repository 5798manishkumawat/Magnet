<?php 
include("Sessions.php");
include("connection.php");
?>

<?php

//session_start();
//$diarycontent="";

if(array_key_exists("email",$_COOKIE))
{

	$_SESSION['email']=$_COOKIE['email'];
}
if(!(array_key_exists("email",$_SESSION)))
{
	//echo "<p>Logged In!<a href='first.php?logout=1'>Logout</a></p>";

	// include("connection.php");

	// $query="SELECT notes FROM `diary` WHERE email=".mysqli_real_escape_string($link,$_SESSION['email'])." LIMIT 1";
	//  $row = mysqli_fetch_array(mysqli_query($link,$query));
	// $diarycontent=$row['notes'];
// }
// else
// {
	header("Location:index.php");
}

include("header.php");
?>

<nav class="navbar navbar-light navbar-fixed-top">
  

  <a class="navbar-brand" href="#">Secret Files</a>

    <div class="pull-right">
      <a href ='index.php?logout=1'>
        <button class="btn btn-success" type="submit" style="margin-right:30px; margin-top:20px;">Logout</button></a>
    </div>

</nav>


<div>
	<div style="margin-top:40px;"><?php echo Message(); echo SuccessMessage(); ?></div>
		<center>
			<form method="POST" action="action.php" enctype="multipart/form-data">
				
				<div class="FORM" style="background-color:none;box-shadow: 20px 20px 20px;border-style:solid;border-width: 2px;width:30%;height:200px; margin-top:130px;">
				<div class="selection"><h1 style="color: white;">Select file to upload:</h1></div>
				<div><input type="file" name="file" id="file"></div>
				<br><br>
				<div><input type="submit" class="btn btn-success" name="submit" value="Upload!!">
				<input type="reset" name="reset" class="btn btn-success" value="Reset"></div>	
				</div>
			</form>
		</center>
</div>

<?php
include("display.php");
include("footer.php");

?>



<!-- <?php /*echo */$diarycontent; ?> -->