<?php 
include("Sessions.php");
include("connection.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Secret Files</title>
</head>
<body>
<?php
$error='';

if(array_key_exists("logout",$_GET))
{
	unset($_SESSION);
	setcookie("email","",time()-60*60);
	$_COOKIE["email"]="";
	$lgo=$_GET['logout'];
	if($lgo==1)
	{
		session_destroy();
		header("Location:index.php");
	}
	
}
else if((array_key_exists("email",$_SESSION) and ($_SESSION['email'] )) or (array_key_exists("email",$_COOKIE) and ($_COOKIE['email'])))
{
	header("Location:loggedinpage.php");
}




if(array_key_exists("submit",$_POST))
{

	include("connection.php");

	

	if(!$_POST["email"])
	{
		$error.="An email address is required!!<br>";
	}

	if(!$_POST["password"])
	{
		$error.="A password is required!!<br>";
	}

	if($error!="")
	{
		$error="<p>There were error(s) in your form:</p>".$error;
	}
	else
	{
		if($_POST['signup']=="1")
		{

				$query="SELECT*FROM `diary` WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."'";

				$results=mysqli_query($link,$query);

				if(mysqli_num_rows($results)>0)
				{

					$error= "That email address is taken.";
				}
				else
				{
					$query="INSERT INTO `diary` (`email`,`password`) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";

					if(!mysqli_query($link,$query))
					{
						$error="<p>Could not sign up you-please try again later!</p>";

					}
					else
					{
						$query="UPDATE `diary` SET password='".md5($_POST["password"])."'  WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."'";

						mysqli_query($link,$query);
						$_SESSION['email']=mysqli_real_escape_string($link,$_POST['email']);//mysqli_insert_id($link);
						$emi=mysqli_real_escape_string($link,$_POST['email']);
						if($_POST['StayloggedIn']=='1')
						{
							setcookie("email",$emi,time()+60*60*24);
						}
						header("Location:loggedinpage.php");
					}
				}	
		}
		else
		{
			$query="SELECT*FROM `diary` WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."'";
			$result=mysqli_query($link,$query);

			$row=mysqli_fetch_array($result);

			if(isset($row))
			{
				$hashpassword=md5($_POST["password"]);

				if($hashpassword==$row['password'])
				{
					$_SESSION['email']=$row['email'];
					if($_POST['StayloggedIn']=="1")
					{
						setcookie("emai",$row['email'],time()+60*60*24);
					}
					header("Location:loggedinpage.php");
				}
				else
				{
					$error="That email/password combination could not be found.";
				}
			}
			else
			{
				$error="That email/password combination could not be found.";
			}
		}

	}

}
?>

<?php include("header.php"); ?>

  	<div class="container" id="homepagecontainer">
    	<h1 style="color:white;">Secret Files</h1>
    		<p><strong style="color:white;">Store your files permanently and securely!! </strong></p>
		<div id="error"><?php  if($error!=""){echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?></div>
		<form method="post" action="" id="loginform">
				<p style="color:white;">Log in using your username and password.</p>
				<fieldset class="form-group">
					<input type="email" class="form-control" name="email" placeholder="Enter your mail here!">
				</fieldset>
				<fieldset class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Enter your password here!">
				</fieldset>
				<div class="checkbox">
					<label style="color:white;">
					<input  type="checkbox"name="StayloggedIn" value=1>Stay Logged In
					</label>
					<input type="hidden" class="form-control" name="signup" value="0">
				</div>
				<fieldset class="form-group">
					<input type="submit" class="btn btn-success" name="submit" value="Login!!">
				</fieldset>
				<p><a class="toggleforms" style="color:white;">Sign up</a></p>
			</form>
			<form method="post" action="" id="signupform">
				<p style="color:white;">Interested? sign up now.</p>
				<fieldset class="form-group">
					<input type="email" class="form-control" name="email" placeholder="Enter your mail here!">
				</fieldset>
				<fieldset class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Enter your password here!">
				</fieldset>
				<fieldset class="form-group">
					<input type="hidden" class="form-control" name="signup" value="1">
					<input type="submit" class="btn btn-success" name="submit" value="Sign up!!">
				</fieldset>
				<p><a class="toggleforms" style="color:white;">Log In</a></p>
			</form>
    </div>
    <?php include("footer.php"); ?>

</body>
</html>