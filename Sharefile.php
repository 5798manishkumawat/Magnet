<?php 
include("Functions.php");
include("Sessions.php");
include("connection.php");
?>

<?php

if(isset($_POST['submit']))
{
	$ShareFromURL=$_GET['Share'];
	if(!$_POST["emal"])
	{
		$_SESSION["ErrorMessage"]="An email address is required!!";
		Redirect_to("Sharefile.php?Share=".$ShareFromURL."");
	}
		global $link;
		//if(!empty($_GET['Share']))
		//{			
		
					$flag=0;
					$query1="SELECT*FROM `diary`";
					$result1=mysqli_query($link,$query1);
					while($row1=mysqli_fetch_array($result1))
					{
						$mailc=$_POST['emal'];
						$mailcd=$row1['email'];
						if($mailcd==$mailc)
						{	

								$flag=1;
							$ShareFromURL=$_GET['Share'];

							$query="SELECT*FROM `doc` WHERE id='$ShareFromURL'";
							$execute=mysqli_query($link,$query);
							$Rows=mysqli_fetch_array($execute);
							$FileName=$Rows['name'];


							$Query="INSERT INTO doc (name,mail,status) VALUES ('".$FileName."','".mysqli_real_escape_string($link,$_POST['emal'])."','OFF')";
							$Execute=mysqli_query($link,$Query);

							if($Execute){
								$_SESSION["SuccessMessage"]="File Shared Successfully!!";
								Redirect_to("loggedinpage.php");
							}
							else{
								$_SESSION["ErrorMessage"]="Please try again!";
								Redirect_to("loggedinpage.php");
							}
						}
					}
					if($flag==0)
					{
						$_SESSION["ErrorMessage"]="Entered email is not registered!";
							Redirect_to("Sharefile.php?Share=".$ShareFromURL."");
					}

		//}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Share Files</title>
</head>
<body>
<?php include('header.php'); ?>
<div style="margin-top:40px;"><?php echo Message(); echo SuccessMessage(); ?></div>
<center>
			<form method="POST" action="" enctype="multipart/form-data">
				
				<div class="FORM" style="background-color:none;box-shadow: 20px 20px 20px;border-style:solid;border-width: 2px;width:30%;height:200px; margin-top:130px;">
				<div class="selection"><h1 style="color: white;">Share file with email :</h1></div>
				<div><input type="email" name="emal" id="emal" placeholder="Enter email here"></div>
				<br><br>
				<div><input type="submit" class="btn btn-primary" name="submit" value="Share!!">
				<input type="reset" name="reset" class="btn btn-success" value="Reset"></div>	
				</div>
			</form>
		</center>
</body>
</html>